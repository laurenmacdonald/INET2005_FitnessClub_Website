<?php

namespace Models;
include_once (__DIR__.'/Model.php');

class ScheduleModel extends Model
{
    /**
     * Get the schedule information from the class table, joining on member, trainer and classtemplate to get
     * name values instead of id values.
     * @param $mysqli
     * @return null
     */
    function getScheduleRecord($mysqli)
    {
        $sql = "SELECT c.id, c.date AS Date, CONCAT(TIME_FORMAT(c.startTime, '%H:%i'), ' - ', 
                    TIME_FORMAT(c.endTime, '%H:%i')) AS Time, ct.className AS Class, CONCAT(t.firstName, ' ', t.lastName) AS Trainer, CONCAT(m.firstName, ' ', m.lastName) AS Member
                FROM class c 
                LEFT JOIN member m ON c.memberId = m.id
                INNER JOIN trainer t ON c.trainerId = t.id
                INNER JOIN classtemplate ct ON ct.id = c.classId
                ORDER BY Date;";
        $result = $mysqli->query($sql);
        if ($result === false) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get the schedule information for open classes and classes booked by the user.
     * Get the user Id from the session variable and use it in where clause.
     * @param $mysqli
     * @return null
     */
    function getOpenings($mysqli)
    {
        $parts = explode('_', $_SESSION['userId']);
        $memberId = $parts[0];
        $sql = "SELECT c.id, c.date AS Date, CONCAT(TIME_FORMAT(c.startTime, '%H:%i'), ' - ', 
                    TIME_FORMAT(c.endTime, '%H:%i')) AS Time, ct.className AS Class, CONCAT(t.firstName, ' ', t.lastName) AS Trainer, c.memberId
                    FROM class c JOIN trainer t ON c.trainerId = t.id JOIN classtemplate ct ON ct.id = c.classId
                    WHERE c.memberId = 0 OR c.memberId = $memberId
                    ORDER BY Date, Time;";
        $result = $mysqli->query($sql);
        if ($result === false) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get the schedule information from the member, using the member id taken from the session variable.
     * @param $mysqli
     * @return null
     */
    function getMemberSchedule($mysqli)
    {
        $parts = explode('_', $_SESSION['userId']);
        $memberId = $parts[0];
        $sql = "SELECT c.id, c.date AS Date, CONCAT(TIME_FORMAT(c.startTime, '%H:%i'), ' - ', 
                    TIME_FORMAT(c.endTime, '%H:%i')) AS Time, ct.className AS Class, CONCAT(t.firstName, ' ', t.lastName) AS Trainer, c.memberId
                    FROM class c JOIN trainer t ON c.trainerId = t.id JOIN classtemplate ct ON ct.id = c.classId
                    WHERE c.memberId = $memberId
                    ORDER BY Date, Time;";
        $result = $mysqli->query($sql);
        if ($result === false) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get the schedule information for the trainer. Case statement used to display member attendance.
     * @param $mysqli
     * @return null
     */
    function getTrainerSchedule($mysqli)
    {
        $parts = explode('_', $_SESSION['userId']);
        $trainerId = $parts[0];
        $sql = "SELECT
                    c.id,
                    c.date AS Date,
                    CONCAT(TIME_FORMAT(c.startTime, '%H:%i'), ' - ', TIME_FORMAT(c.endTime, '%H:%i')) AS Time,
                    ct.className AS Class,
                    CONCAT(m.firstName, ' ', m.lastName) AS Member,
                    c.memberId,
                    c.memberAttendance AS Attendance,
                    CASE
                        WHEN c.memberId = 0 THEN 'N/A'
                        WHEN c.memberAttendance IS NULL THEN 'Absent'
                        WHEN c.memberId != 0 AND c.memberAttendance IS NOT NULL THEN 'Attended'
                    END AS AttendanceStatus
                FROM
                    class c
                LEFT JOIN member m ON c.memberId = m.id
                JOIN classtemplate ct ON ct.id = c.classId
                WHERE c.trainerId = $trainerId
                ORDER BY
                    Date, Time;";
        $result = $mysqli->query($sql);
        if ($result === false) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get the list of trainers
     * @param $mysqli
     * @return null
     */
    function getTrainerList($mysqli){
        $sql = "SELECT id, CONCAT(firstName, ' ', lastName) AS TrainerName 
        FROM trainer;";
        $result = $mysqli->query($sql);
        if ($result === false) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get the list of classes
     * @param $mysqli
     * @return null
     */
    function getClassList($mysqli){
        $sql = "SELECT id, className, classDescription FROM classtemplate;";
        $result = $mysqli->query($sql);
        if ($result === false) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Adding a class record
     * @param $mysqli
     * @param $date
     * @param $startTime
     * @param $endTime
     * @param $classId
     * @param $trainer
     * @return void
     */
    function addClass($mysqli, $date, $startTime, $endTime, $classId, $trainer): void {
        $sql = "INSERT INTO class (date, startTime, endTime, classId, trainerId) 
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('sssii', $date, $startTime, $endTime, $classId, $trainer);
        $stmt->execute();
    }
}
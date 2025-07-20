<?php

use app\core\DataBase;

DataBase::getInstance()->executeDDL("
    ALTER VIEW teacher_assignments_view AS
    SELECT
        classes.id AS class_id,
        classes.name AS class_name,
        users.id AS user_id,
        users.login AS user_login,
        assignments.id AS assignment_id,
        assignments.path AS assignment_file,
        assignments.due_date,
        CASE
            WHEN submissions.id IS NOT NULL THEN 'Passed'
            ELSE 'Not passed'
        END AS submission_status,
        submissions.submission_date,
        submissions.path AS submission_file,
        submissions.grade,
        classes.owner_id
    FROM classes
    INNER JOIN users_classes ON classes.id = users_classes.class_id
    INNER JOIN users ON users.id = users_classes.user_id
    LEFT JOIN assignments ON assignments.class_id = classes.id
    LEFT JOIN submissions
        ON submissions.assignment_id = assignments.id
        AND submissions.user_id = users.id
    WHERE  users.id IS NOT NULL AND classes.owner_id <> users.id
    ORDER BY classes.id, users.id, assignments.id;
");


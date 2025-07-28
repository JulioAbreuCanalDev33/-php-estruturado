<?php

function connectDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");
    return $conn;
}

function executeQuery($sql, $params = []) {
    $conn = connectDB();
    
    if (!empty($params)) {
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        } else {
            $result = false;
        }
    } else {
        $result = $conn->query($sql);
    }
    
    $conn->close();
    return $result;
}

function getLastInsertId($conn = null) {
    // Utilize the same database connection that performed the INSERT to avoid always returning 0.
    if ($conn instanceof mysqli) {
        return $conn->insert_id;
    }
    // Fallback for backward-compatibility – create a connection only if one was not passed in.
    $tmpConn = connectDB();
    $id = $tmpConn->insert_id;
    $tmpConn->close();
    return $id;
}

?>


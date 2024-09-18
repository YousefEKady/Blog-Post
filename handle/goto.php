<?php
require_once '../App.php';

if ($request->check($request->get("id")) && $request->check($request->get("status"))) {
    $id = $request->get("id");
    $status = $request->get("status");

    $runQuery = $conn->prepare("SELECT * FROM todo WHERE id = :id");
    $runQuery->bindParam(":id", $id);
    $runQuery->execute();
    if ($runQuery->rowCount() == 1) {

        $result = $conn->prepare("UPDATE todo SET `status`=:status WHERE id=:id");
        $result->bindParam(":id", $id);
        $result->bindParam(":status", $status);
        $output = $result->execute();

        if ($output) {
            $session::set("success", "Status Updated Successfuly");
            $request->headerLocation("../index.php");
        } else {
            $session::set("errors", ["Error While Update Status"]);
            $request->headerLocation("../index.php");
        }

    } else {
        $session::set("errors", ["Todo Not Found"]);
        $request->headerLocation("../index.php");
    }
} else {
    $request->headerLocation("../index.php");
}
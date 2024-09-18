<?php
require_once '../App.php';

if ($request->check($request->get("id"))) {
    $id = $request->get("id");

    $runQuery = $conn->prepare("SELECT * FROM todo WHERE id = :id");
    $runQuery->bindParam(":id", $id);
    $runQuery->execute();
    if ($runQuery->rowCount() == 1) {
        $runQuery = $conn->prepare("DELETE FROM todo WHERE id = :id");
        $runQuery->bindParam(":id", $id);
        $result = $runQuery->execute();
        if ($result) {
            $session::set("success", "Todo Deleted Successfuly");
            $request->headerLocation("../index.php");
        } else {
            $session::set("errors", ["Error Occured When Delete Todo"]);
            $request->headerLocation("../index.php");
        }
    }

} else {
    $request->headerLocation("../index.php");
}
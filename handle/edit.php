<?php
require_once '../App.php';

if ($request->check($request->post("submit")) && $request->check($request->get("id"))) {
    // Catch
    $id = $request->get("id");
    $title = $request->filter($request->post("title"));
    // Validation
    $validation->endValidate("title", $title, ["Required", "Str"]);
    $errors = $validation->getError();
    if (empty($errors)) {

        $runQuery = $conn->prepare("SELECT * FROM todo WHERE id=:id");
        $runQuery->bindParam(":id", $id);
        $runQuery->execute();
        if ($runQuery->rowCount() == 1) {
            $runQuery = $conn->prepare("UPDATE todo SET `title`=:title WHERE id=:id");
            $runQuery->bindParam(":title", $title);
            $runQuery->bindParam(":id", $id);
            $result = $runQuery->execute();

            if ($result) {
                $session::set("success", "Todo Updated Successfuly");
                $request->headerLocation("../index.php");
            } else {
                $session::set("errors", ["Error While Update"]);
                $request->headerLocation("../edit.php");
            }


        } else {
            $session::set("errors", ["Todo Not Found"]);
            $request->headerLocation("../index.php");
        }

    } else {
        $session::set("errors", $errors);
        $request->headerLocation("../edit.php?id=$id");
    }
} else {
    $request->headerLocation("../index.php");
}
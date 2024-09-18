<?php
require_once '../App.php';

// Check for the form

if ($request->check($request->post("submit"))) {
    // Data
    $title = $request->filter($request->post("title"));

    // Validation
    //title (requierd, str)
    $validation->endValidate("title", $title, ["Required", "Str"]);
    $errors = $validation->getError();
    if (empty($errors)) {
        $runQuery = $conn->prepare("INSERT INTO todo(`title`) VALUES(:title)");
        $runQuery->bindParam(":title", $title, PDO::PARAM_STR);
        $result = $runQuery->execute();
        if ($result) {
            $session::set("success", "Data Inserted Successfuly");
            $request->headerLocation("../index.php");
        } else {
            $session::set("errors", ["Error While Insert"]);
            $request->headerLocation("../index.php");
        }
    } else {
        $session::set("errors", $errors);
        $request->headerLocation("../index.php");
    }

} else {
    $request->headerLocation("../index.php");
}
<?php
require_once 'inc/header.php';
require_once 'App.php';
?>

<?php
if ($request->get("id")) {
    $id = $request->get("id");
    $runQuery = $conn->prepare("SELECT * FROM todo WHERE id=:id");
    $runQuery->bindParam(":id", $id);
    $runQuery->execute();
    if ($runQuery->rowCount() == 1) {
        $data = $runQuery->fetch(PDO::FETCH_ASSOC);
    } else {
        $session::set("errors", ["Todo Not Found"]);
        $request->headerLocation("index.php");
    }
} else {
    $request->headerLocation("index.php");
}
?>

<body class="container w-50 mt-5">
    <?php
    require_once 'inc/success.php';
    require_once 'inc/errors.php';
    ?>
    <form action="handle/edit.php?id=<?php echo $id ?>" method="post">
        <textarea type="text" class="form-control" name="title" id=""
            placeholder="enter your note here"><?php echo $data['title'] ?></textarea>
        <div class="text-center">
            <button type="submit" name="submit" class="form-control text-white bg-info mt-3 ">Update</button>
        </div>
    </form>
</body>

</html>
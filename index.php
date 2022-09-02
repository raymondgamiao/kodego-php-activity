<?php
require_once 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <?php
                if (isset($_SESSION["message"])) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo $_SESSION["message"];
                    echo '</div>';
                }
                ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">Add Student</button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addSubject">Add Subject</button>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Student ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Subjects</th>
                            <th scope="col">Total Grade</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT id, firstname, lastname, total_grade FROM students";
                        $result = mysqli_query($link, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row["id"] . '</td>';
                                echo '<td>' . $row["firstname"] . '</td>';
                                echo '<td>' . $row["lastname"] . '</td>';
                                echo '<td><table>';
                                $studID = $row['id'];
                                $sql2 = "SELECT * FROM subjects WHERE student_id = $studID";
                                $result2 = mysqli_query($link, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        echo '<tr><td>' . $row2["subjectname"] . '</td></tr>';
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>no results</td></tr>";
                                }
                                echo '</table></td>';
                                echo '<td>' . $row["total_grade"] . '</td>';
                                echo '<tr>';
                            }
                        } else {
                            echo "<tr><td>no results</td></tr>";
                        }
                        mysqli_close($link);
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="addstudent.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Enter first name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="first name">
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">enter last name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="last name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="addgrade.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Subject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject name</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject name">
                        </div>
                        <div class="mb-3">
                            <label for="grade" class="form-label">Grade</label>
                            <input type="text" class="form-control" name="grade" id="grade" placeholder="grade">
                        </div>
                        <div class="mb-3">
                            <label for="studentid" class="form-label">Student ID</label>
                            <input type="text" class="form-control" name="studentid" id="studentid" placeholder="Student ID">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>
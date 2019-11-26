<?php

function confirm_query($result, $msg)
{
    global $con;
    if (!$result) {
        echo '<div class="alert alert-danger">' . $msg . ' ' . mysqli_error($con) . '</div>';
        die;
    }
}

function redirect(string $path)
{
    header("Location: {$path}");
    exit;
}

function is_record_exist($result): bool
{
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function username_exists($username)
{

    global $con;

    $query = "SELECT * FROM users WHERE username='$username'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0)
        return true;
    else return false;
}

function login_user($username, $password) {
    global $con;

    $query = "SELECT * FROM users WHERE username='$username'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)):
            $user_id = $row['user_id'];
            $user_role = $row['user_role'];
            $db_password = $row['password'];

            if (password_verify($password, $db_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['user_role'] = $user_role;

                redirect('admin/');

            } else {
                return false;
            }
        endwhile;
    } else {
        return false;
    }
}

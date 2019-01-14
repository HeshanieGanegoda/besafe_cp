<?php

require_once 'database.php';
class User
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function lasdID()
    {
        $stmt = $this->conn->lastInsertId();
        return $stmt;
    }

    public function update($bankname,$bankcode,$email,$upass,$id)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT * FROM banks WHERE BankId=:uid");
            $stmt->execute(array(":uid"=>$id));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);



            if($stmt->rowCount() >0)
            {




                if($userRow['BankStatus']=="Y")
                {
                    // return $userRow['Passsword'];

                    if($userRow['Passsword'] == md5($upass))
                    {







                        $statusN = "N";



                        $stmt = $this->conn->prepare("UPDATE banks SET BankCode = :bank_code ,BankName = :bank_name ,Email = :bank_mail, BankStatus = :bank_status WHERE BankId = :uid");

                        $stmt->execute(array(":bank_code"=>$bankcode,":bank_name"=>$bankname,":bank_mail"=>$email,":bank_status"=>$statusN,":uid"=>$id));






                        $_SESSION['userName'] = $bankcode;



                        return $stmt;











                    }
                    else
                    {
                        header("Location: profile.php?error");
                        exit;
                    }
                }
                else
                {
                    header("Location: profile.php?inactive");
                    exit;
                }
            }
            else
            {
                header("Location: profile.php?error");
                exit;
            }
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function register($bankname,$bankcode,$apikey,$email,$upass,$code)
    {
        try
        {
            $password = md5($upass);
            $stmt = $this->conn->prepare("INSERT INTO banks(BankCode,BankName,Email,Passsword,ApiKey,tokenCode) 
			                                             VALUES(:bank_code,:bank_name, :bank_mail, :bank_pass, :api_key,:active_code)");
            $stmt->bindparam(":bank_code",$bankcode);
            $stmt->bindparam(":bank_name",$bankname);
            $stmt->bindparam(":bank_mail",$email);
            $stmt->bindparam(":bank_pass",$password);
            $stmt->bindparam(":active_code",$code);
            $stmt->bindparam(":api_key",$apikey);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function login($email,$upass)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT * FROM banks WHERE Email=:email_id");
            $stmt->execute(array(":email_id"=>$email));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);



            if($stmt->rowCount() == 1)
            {




                if($userRow['BankStatus']=="Y")
                {
                    // return $userRow['Passsword'];

                    if($userRow['Passsword'] == md5($upass))
                    {

                        $_SESSION['userSession'] = $userRow['BankId'];
                        $_SESSION['userToken'] = $userRow['tokenCode'];
                        $_SESSION['userName'] = $userRow['BankCode'];
                        $_SESSION['ApiKey'] = $userRow['ApiKey'];

                        return true;
                    }
                    else
                    {
                        header("Location: index.php?error");
                        exit;
                    }
                }
                else
                {
                    header("Location: index.php?inactive");
                    exit;
                }
            }
            else
            {
                header("Location: index.php?error");
                exit;
            }
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }


    public function is_logged_in()
    {
        if(isset($_SESSION['userSession']))
        {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        $_SESSION['userSession'] = false;
    }

    function send_mail($email,$message,$subject)
    {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "";
        $mail->Host       = "";
        $mail->Port       = "";
        $mail->AddAddress($email);
        $mail->Username="";
        $mail->Password="";
        $mail->SetFrom('');
        $mail->AddReplyTo("");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}
<?php
    include __DIR__.'/../config.php';
    class User extends Database
    {
        public function checkUserExistance($username)//for login
	    {
            $q="select * from tbl_user where Username='$username' and UserDeletedAt IS NULL and UserStatus='1'";
            return $this->connection()->query($q);
        }

        public function checkUserExistanceForAllPage($username,$password,$usertype)//for all page
	    {
            $q="select * from tbl_user where Username='$username' and Password='$password' and Usertype='$usertype' and UserDeletedAt IS NULL and UserStatus='1'";
            return $this->connection()->query($q);
        }

        public function userDetails($usertype,$userid)
        {
            if($usertype=="A" || $usertype =="a")
            {
                $q="select * from tbl_admin where UserID='$userid'";
                return $this->connection()->query($q);
            }
            elseif($usertype=="F" || $usertype =="f")
            {
                $q="select * from tbl_faculty where UserID='$userid'";
                return $this->connection()->query($q);
            }
            elseif($usertype=="S" || $usertype =="s")
            {
                $q="select * from tbl_student where UserID='$userid'";
                return $this->connection()->query($q);
            }
            else
            {
                return false;
            }
        }
        //for pass any single queary
        public function query($string=";")
        {
            $q =$string;
            return $this->connection()->query($q);
        }

        //for all tables

        public function tbl_users($string=";")
        {
            $q = "SELECT * FROM tbl_user WHERE UserDeletedAt IS NULL AND UserStatus = '1' ".$string;
            return $this->connection()->query($q);
        }
        
        public function tbl_student($string=";")
        {
            $q = "SELECT
                    tbl_user.*,
                    tbl_student.*
                FROM
                    tbl_student
                INNER JOIN tbl_user ON tbl_student.UserID = tbl_user.UserID
                where tbl_user.UserDeletedAt IS NULL ".$string;
            return $this->connection()->query($q);
        }
        

        public function tbl_academicyear($string=";")
        {
            $q = "SELECT * from tbl_academicyear WHERE tbl_academicyear.AcademicYearEndAt IS null ".$string;
            return $this->connection()->query($q);
        }

        public function tbl_course($string=";")
        {
            $q="Select * from tbl_course ".$string;
            return $this->connection()->query($q);
        }

        public function tbl_semester_devition($string=";")
        {
            $q="Select * from tbl_semester_divition ".$string;
            return $this->connection()->query($q);
        }

        public function tbl_course_semester($string=";")
        {
            $q="SELECT
                tbl_course_semester.*,
                tbl_academicyear.*,
                tbl_course.*,
                tbl_semester_divition.*
            FROM
                `tbl_course_semester`
                INNER JOIN tbl_academicyear ON tbl_course_semester.AcademicYearID = tbl_academicyear.AcademicYearID
                INNER JOIN tbl_course ON tbl_course_semester.CourseID = tbl_course.CourseID
                INNER JOIN tbl_semester_divition ON tbl_course_semester.SemesterDivitionID=tbl_semester_divition.SemesterDivitionID ".$string;
            return $this->connection()->query($q);

            
        }

        public function tbl_subject($string=";")
        {
            $q="select * from tbl_subject ".$string;
            return $this->connection()->query($q); 
        }

        public function tbl_semester_subject($string=";")
        {
            $q="SELECT
                tbl_semester_subject.*,
                tbl_subject.*,
                tbl_course_semester.*,
                tbl_academicyear.*,
                tbl_course.*,
                tbl_semester_divition.*
            FROM
                tbl_semester_subject
            INNER JOIN tbl_course_semester on tbl_semester_subject.CourseSemesterID=tbl_course_semester.CourseSemesterID
            INNER JOIN tbl_subject on tbl_semester_subject.SubjectID=tbl_subject.SubjectID
            INNER JOIN tbl_academicyear on tbl_course_semester.AcademicYearID=tbl_academicyear.AcademicYearID
            INNER JOIN tbl_course on tbl_course_semester.CourseID=tbl_course.CourseID
            INNER JOIN tbl_semester_divition on tbl_course_semester.SemesterDivitionID=tbl_semester_divition.SemesterDivitionID ".$string;
        
            return $this->connection()->query($q);

        // WHERE tbl_academicyear.AcademicYearEndAt is null and tbl_course_semester.SemesterEndDate is null
        }

        public function tbl_state($string=";")
        {
            $q="select * from tbl_state ".$string;
            return $this->connection()->query($q); 
        }

        public function tbl_city($string=";")
        {
            $q="SELECT
                    tbl_state.*,
                    tbl_city.*
                FROM
                    tbl_city
                INNER JOIN tbl_state ON tbl_city.CityID = tbl_state.StateID ".$string;
            return $this->connection()->query($q); 
        }
        

        public function encrypt($plainText)
        {
            $ciphering="AES-128-CTR";//it store cipher method
            $option=0;//
            $encryption_iv='1234567890123456';//it hold the initialization vector wich is not null
            $encryption_key="hello";
            return openssl_encrypt($plainText,$ciphering,$encryption_key,$option,$encryption_iv);
        }

        public function decrypt($cypherText)
        {
            $ciphering="AES-128-CTR";//it store cipher method
            $option=0;//
            $encryption_iv='1234567890123456';//it hold the initialization vector wich is not null
            $encryption_key="hello";
            return openssl_decrypt($cypherText,$ciphering,$encryption_key,$option,$encryption_iv);
        }
    }

    
?>
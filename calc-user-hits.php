<?php
// getting db conn
            $utilities = new Utilities();

            //  Calculate and storing hits and users
            //  Get IP Address
            $userIP_Address = $_SERVER['REMOTE_ADDR'];

//            echo '<pre>';print_r($userIP_Address);exit;
            //  Defining hit = 1 by default
            $userHit = 1;

            //  counter for the date
            $countArrayDate = 0;

            // variable to find if the IP Address is matched or not
            $boolIP_Found = FALSE;

            // getting today date
            $date = date('Y-m-d', strtotime('now'));

            // getting data for today and IP address
            $query = "SELECT hit_id, date, ip_address, hits FROM user_hits WHERE date=\"$date\" AND ip_address=\"$userIP_Address\"";

//                        echo '<pre>';print_r($query);exit;
                // check if data is present for that date and ip address or not
            if ($result = $utilities->selectQuery($query)) {
                    if ($rows = $result->fetch_array()) {
                        //  increasing current hit by 1
                        $userHit = $rows['hits'] + 1;
                        $query = "UPDATE user_hits SET hits=$userHit WHERE hit_id=" . $rows['hit_id'];
                    }
            } else {
                    $query = "INSERT INTO user_hits(date, ip_address, hits) "
                            . " VALUES(\"$date\", \"$userIP_Address\", $userHit)";
                }
                $utilities->executeQuery($query);
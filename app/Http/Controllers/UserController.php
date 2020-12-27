<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // UserController that we created
    public function index()
    {
        $users = DB::select('select * from movies');
        echo "<h1>Listing Movies in the Database (Total Records: ";
        echo count($users) . ")</h1>";
        echo "<table style=" . "width:100%" . ">";
        echo 
        "<tr>
            <th>Title</th>
            <th>Original Title</th>
            <th>Release Year</th>
            <th>Duration</th>
            <th>Genre</th>
        </tr>";
        foreach ($users as $user) {
            if($user->titleType != "moviee"){
                echo "<tr>";
                //echo "<td>" . $user->titleType . "</td>";
                echo "<td>" . $user->primaryTitle . "</td>";
                echo "<td>" . $user->originalTitle . "</td>";
                //echo "<td>" . $user->isAdult . "</td>";
                echo "<td>" . $user->startYear . "</td>";
                //echo "<td>" . $user->endYear . "</td>";
                echo "<td>" . $user->runtimeMinutes . "</td>";
                echo "<td>" . $user->genres . "</td>";
                echo "</tr>";
            }
            else{
                //nop
            }
        }
        echo "</table>";

        echo "<style>
        h1 {
            text-align: center;
            font-size: 200%;
        }
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 4px solid #000000;
          text-align: center;
          padding: 8px;
        }
        
        tr {
          background-color: #f3cd98;
        }
        </style>";
    }

    public function getRatingsInfo($selectedMovieIndex)
    {
        $ratings = DB::select('select * from ratings');
        return $ratings[$selectedMovieIndex];
    }

    // creates random integer for movie index.
    public function createRandomMovieIndex($maxMovieIndex)
    {
        return rand(0, $maxMovieIndex-1);
    }

    // Selects randomly a movie from the db
    public function chooseMovie()
    {
        $users = DB::select('select * from movies');
        $arrayLength = count($users);
        $selectedMovieIndex = self::createRandomMovieIndex($arrayLength);        
        
        $selectedMovieIndex_ = $selectedMovieIndex + 1;
        $imagePath = "moviesThumbs/" . $selectedMovieIndex_ . ".jpg";
        
        echo "<style>
        img {
            width: 25%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 20px;
        }
        h1 {
            text-align: center;
            font-size: 200%;
        }
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
          margin-left: auto;
          margin-right: auto;
        }
        
        td, th {
          border: 4px solid #000000;
          text-align: center;
          padding: 8px;
        }
        
        tr {
          background-color: #f3cd98;
        }
        </style>";

        echo '<img src="' . url($imagePath) . '"/>';
        echo "<table style=" . "width:50%" . ">";
            echo "<tr>";
                echo "<th>" . "Title" . "</th>";
                echo "<th>" . $users[$selectedMovieIndex]->primaryTitle . "</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>" . "Director" . "</th>";
                echo "<th>" . $users[$selectedMovieIndex]->director . "</th";
            echo "<tr>";
            echo "</tr>";
                echo "<th>" . "Release Year" . "</th>";
                echo "<th>" . $users[$selectedMovieIndex]->startYear . "</th>";
            echo "</tr>";
            echo "</tr>";
                echo "<th>" . "Duration" . "</th>";
                echo "<th>" . $users[$selectedMovieIndex]->runtimeMinutes . "</th>";
            echo "<tr>";
            echo "</tr>";
                echo "<th>" . "Genre" . "</th>";
                echo "<th>" . $users[$selectedMovieIndex]->genres . "</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>" . "Rating" . "</th>";
                echo "<th>" . $users[$selectedMovieIndex]->avarageRating . "</th>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>" . "Cast" . "</th>";
                echo "<th>" . $users[$selectedMovieIndex]->crew . "</th>";
            echo "</tr>";
        echo "</table>";
        
    }
}

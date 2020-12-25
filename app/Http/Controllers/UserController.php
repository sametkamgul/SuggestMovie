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
        return rand(0, $maxMovieIndex);
    }

    // Selects randomly a movie from the db
    public function chooseMovie()
    {
        $users = DB::select('select * from movies');
        $arrayLength = count($users);
        $selectedMovieIndex = self::createRandomMovieIndex($arrayLength);
        
        //echo $users[$selectedMovieIndex]->primaryTitle;
        echo "<h1>Suggested Movie</h1>";
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
        echo "<table style=" . "width:100%" . ">";
        echo 
        "<tr>
            <th>Title</th>
            <th>Original Title</th>
            <th>Release Year</th>
            </tr>
            ";
        echo "<tr>";
            //echo "<td>" . $user->titleType . "</td>";
            echo "<td>" . $users[$selectedMovieIndex]->primaryTitle . "</td>";
            echo "<td>" . $users[$selectedMovieIndex]->originalTitle . "</td>";
            //echo "<td>" . $user->isAdult . "</td>";
            echo "<td>" . $users[$selectedMovieIndex]->startYear . "</td>";
            //echo "<td>" . $user->endYear . "</td>";
            echo "</tr>";
            echo "<tr>
                <th>Duration</th>
                <th>Genre</th>
                <th>Imdb Rating</th>
                <th>Votes</th>
            </tr>";
            echo "<tr>";
            echo "<td>" . $users[$selectedMovieIndex]->runtimeMinutes . " min" . "</td>";
            echo "<td>" . $users[$selectedMovieIndex]->genres . "</td>";
            echo "<td>" . self::getRatingsInfo($selectedMovieIndex)->avarageRating . "</td>";
            echo "<td>" . self::getRatingsInfo($selectedMovieIndex)->numVotes . "</td>";
        echo "</tr>";
        echo "</table>";
        
    }
}

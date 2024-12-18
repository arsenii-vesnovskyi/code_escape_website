<?php
    // Start or resume the user's session
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags for character encoding and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the games page -->
    <title>Game Page</title>

    <!-- Linking Google Fonts that we have found for our website -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Linking external CSS stylesheet -->
    <link rel="stylesheet" href="styles.css">

    <!-- Here we define the JavaScript functions to sort and filter the games based on the user's preferences. -->
    <script>

        // This function displays a popup message based on the user's proficiency level and the game's difficulty.
        function showPopup(gameName, gameDifficulty) {

            // Get the user's proficiency level from the HTML element.
            var proficiency = document.getElementById("proficiency").textContent.split(": ")[1];

            // Define the minimum and maximum difficulty levels for each proficiency level.
            var minDifficulty, maxDifficulty;

            // Set the minimum and maximum difficulty levels based on the user's proficiency.
            switch(proficiency) {
                case 'Beginner':
                    minDifficulty = 1;
                    maxDifficulty = 2;
                    break;
                case 'Intermediate':
                    minDifficulty = 3;
                    maxDifficulty = 6;
                    break;
                case 'Proficient':
                    minDifficulty = 7;
                    maxDifficulty = 9;
                    break;
                case 'Advanced':
                    minDifficulty = 10;
                    maxDifficulty = 10;
                    break;
            }
            
            // Display a message based on the user's proficiency level and the game's difficulty.
            if(gameDifficulty <= maxDifficulty) {
                alert(gameName + " is currently in development. We will notify you when it's finished.");
            } else {
                alert("Your proficiency level is " + proficiency +" which is not sufficient for this game. Please try completing the games with lower levels of difficulty.");
            }
        }
        
        // This function sorts the games based on the selected criteria (difficulty, rating, or completion time) and order (ascending or descending).
        function sortGames() {
            // Get the selected criteria and order from the dropdowns.
            var sortBy = document.getElementById("sort-by").value;
            var sortOrder = document.getElementById("sort-order").value;

            // Get all the games from the games container.
            var gamesContainer = document.getElementById("games-container");

            // Convert the HTMLCollection of games to an array for sorting.
            var games = Array.prototype.slice.call(gamesContainer.getElementsByClassName("game"));
            
            // Sort the games based on the selected criteria and order.
            games.sort(function(a, b) {
                var aValue, bValue;
                
                // Get the value of the selected criteria for each game.
                switch(sortBy) {
                    case 'difficulty':
                        aValue = parseInt(a.getElementsByClassName("difficulty")[0].innerText.split(' ')[1]);
                        bValue = parseInt(b.getElementsByClassName("difficulty")[0].innerText.split(' ')[1]);
                        break;
                    case 'rating':
                        aValue = a.getElementsByClassName("stars")[0].innerText.split('★').length - 1;
                        bValue = b.getElementsByClassName("stars")[0].innerText.split('★').length - 1;
                        break;
                    case 'completion-time':
                        aValue = parseInt(a.getElementsByClassName("completion-time")[0].innerText.split(' ')[3]);
                        bValue = parseInt(b.getElementsByClassName("completion-time")[0].innerText.split(' ')[3]);
                        break;
                }
                
                // Sort the games in ascending or descending order based on the selected criteria.
                if(sortOrder === 'ascending') {
                    return aValue - bValue;
                } else {
                    return bValue - aValue;
                }
            });

            // Append the sorted games to the games container.
            games.forEach(function(game) {
                gamesContainer.appendChild(game);
            });
        }

        // This function filters the games based on the selected category.
        function filterGames() {
            // Get the selected category from the dropdown.
            var filterCategory = document.getElementById("filter-category").value;

            // Get all the games from the games container.
            var gamesContainer = document.getElementById("games-container");

            // Get each game from the games container.
            var games = gamesContainer.getElementsByClassName("game");
            
            // Show or hide each game based on the selected category.
            for (var i = 0; i < games.length; i++) {

                // For each game
                var game = games[i];

                // Get the category of the game
                var category = game.getElementsByTagName("p")[0].innerText.split(": ")[1]; // Extracts the category from the second <p> element
                
                // Show or hide the game based on the selected category
                if (filterCategory === "all" || category === filterCategory) {
                    game.style.display = ""; // Show game
                } else {
                    game.style.display = "none"; // Hide game
                }
            }
        }

    </script>
</head>

<body>
    <!-- Here we define the HTML content for the games page. -->

    <!-- Header Section -->
    <header>
        <!-- Navigation bar with logo and links -->
        <nav class="navbar">
            <div class="logo">
                <!-- Logo linking to the homepage -->
                <a href="index_logged_in.html">CodeEscape</a>
            </div>
            <!-- Navigation links for different sections of the website -->
            <ul class="nav-links">
                <li><a href="index_logged_in.html">Home</a></li>
                <li><a href="games_page_logged_in.php">Games</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="about_us_logged_in.html">About</a></li>
                <li><a href="contact_us_logged_in.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <!-- The heading for the games page is displayed here. -->
    <section class = hero>
        <h1>Available Games</h1>
    </section>
    <!-- The dropdowns for sorting and filtering the games are displayed here. -->
    <label for="sort-by" style="font-size: 18px; margin-right: 0px;" >Sort by:</label>

    <!-- The dropdown for selecting the criteria to sort the games -->
    <select id="sort-by" onchange="sortGames()">
        <!-- The options for sorting the games based on difficulty, rating, or completion time -->
        <option value="difficulty" style="font-size: 18px;">Difficulty</option>
        <option value="rating" style="font-size: 18px;">Rating</option>
        <option value="completion-time" style="font-size: 18px;">Estimated Completion Time</option>
    </select>

    <!-- The dropdown for selecting the order to sort the games -->
    <label for="sort-order" style="font-size: 18px; margin-right: 0px;">Order:</label>
    <select id="sort-order" onchange="sortGames()">
        <!-- The options for sorting the games in ascending or descending order -->
        <option value="ascending" style="font-size: 18px;">Ascending</option>
        <option value="descending" style="font-size: 18px;">Descending</option>
    </select>

    <!-- The dropdown for filtering the games based on the category -->
    <label for="filter-category" style="font-size: 18px; margin-right: 0px;">Filter by Category:</label>
    <select id="filter-category" style="font-size: 18px; margin-right: 0px;" onchange="filterGames()">
        <!-- The options for filtering the games based on the category: All, HTML, CSS, JavaScript, or SQL -->
        <option value="all" style="font-size: 18px;">All</option>
        <option value="HTML" style="font-size: 18px;">HTML</option>
        <option value="CSS" style="font-size: 18px;">CSS</option>
        <option value="JavaScript" style="font-size: 18px;">JavaScript</option>
        <option value="SQL" style="font-size: 18px;">SQL</option>
    </select>

    <!-- The display of the proficiency level -->
    <label id="proficiency" style="font-size: 18px; margin-right: 0px;">Your proficiency level: </label>
    
    <!-- The JavaScript code to update the proficiency level based on the user's session -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Accessing the proficiency level directly from PHP session variable, which is initialized in the login or signup page
            let proficiencyLevel = "<?php echo isset($_SESSION['proficiency']) ? $_SESSION['proficiency'] : ''; ?>";
            
            // Update the HTML element with the proficiency level
            document.getElementById('proficiency').textContent += proficiencyLevel;
        });
    </script>


    <!-- The container for displaying the games is defined here. -->
    <div id="games-container">

        <!-- The container for the first game is defined here. -->
        <div class="game">

            <!-- The image for the first game is displayed here. -->
            <img src="assets/game1.gif" alt="Game 1 Preview">

            <!-- The information for the first game is displayed here. -->
            <div class="game-info">
                <h2>HTML Treasure Hunt</h2>
                <p>Category: HTML</p>
                <p class="difficulty">Difficulty: 1</p>
                <!-- The rating for the first game is displayed here using star symbols. -->
                <p>Rating: <span class="stars">&#9733;&#9733;&#9734;&#9734;&#9734;</span></p>
                <p class="completion-time">Estimated Completion Time: 10 minutes</p>
                <button onclick="showPopup('HTML Treasure Hunt', 1)">Play</button>
            </div>

            <!-- The description for the first game is displayed here. -->
            <div class="game-description">
                <h2>What is this game about?</h2>
                <p>Embark on an HTML adventure where you need to navigate through a mysterious island. Solve puzzles by using HTML tags to unlock treasures and hidden passages. Perfect for honing your skills with elements, attributes, and basic structure.</p>
                <h2>What our users think about it?</h2>
                <p>“HTML Treasure Hunt provided an excellent introduction to HTML. The puzzles were challenging yet rewarding, making it a great way to learn the basics while having fun.” - Emily Davis</p>
            </div>
        </div>
        
        <!-- The structure for the rest of the games is similar to the first game. -->
        <!-- The container for the second game is defined here. -->
        <div class="game">
            <img src="assets/game2.gif" alt="Game 2 Preview">
            <div class="game-info">
                <h2>The Markup Mystery</h2>
                <p>Category: HTML</p>
                <p class="difficulty">Difficulty: 2</p>
                <p>Rating: <span class="stars">&#9733;&#9733;&#9734;&#9734;&#9734;</span></p>
                <p class="completion-time">Estimated Completion Time: 20 minutes</p>
                <button onclick="showPopup('The Markup Mystery', 2)">Play</button>
            </div>
            <div class="game-description">
                <h2>What is this game about?</h2>
                <p>Step into a haunted house where every room holds a secret. Use your knowledge of HTML to decode clues and escape the house. This game focuses on understanding semantic HTML and structuring content effectively.</p>
                <h2>What our users think about it?</h2>
                <p>“The Markup Mystery was an engaging way to delve into HTML. The haunted house theme made learning about semantic HTML enjoyable and memorable.” - Michael Brown</p>
            </div>
        </div>
        
        <!-- The container for the third game is defined here. -->
        <div class="game">
            <img src="assets/game3.gif" alt="Game 3 Preview">
            <div class="game-info">
                <h2>CSS Safari</h2>
                <p>Category: CSS</p>
                <p class="difficulty">Difficulty: 3</p>
                <p>Rating: <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</span></p>
                <p class="completion-time">Estimated Completion Time: 10 minutes</p>
                <button onclick="showPopup('CSS Safari', 3)">Play</button>
            </div>
            <div class="game-description">
                <h2>What is this game about?</h2>
                <p>Join an adventurous safari where your CSS skills will help you camouflage with the surroundings. Apply various CSS styles to blend in with the environment and avoid detection by wild animals. A fun way to practice selectors, properties, and the box model.</p>
                <h2>What our users think about it?</h2>
                <p>“CSS Safari took my CSS knowledge to the next level. The immersive gameplay and real-world scenarios helped me grasp complex concepts easily.” - Jessica Lee</p>
            </div>
        </div>
        
        <!-- The container for the fourth game is defined here. -->
        <div class="game">
            <img src="assets/game4.gif" alt="Game 4 Preview">
            <div class="game-info">
                <h2>Styling Secrets</h2>
                <p>Category: CSS</p>
                <p class="difficulty">Difficulty: 4</p>
                <p>Rating: <span class="stars">&#9733;&#9733;&#9733;&#9734;&#9734;</span></p>
                <p class="completion-time">Estimated Completion Time: 20 minutes</p>
                <button onclick="showPopup('Styling Secrets', 4)">Play</button>
            </div>
            <div class="game-description">
                <h2>What is this game about?</h2>
                <p>Enter the enchanted forest where you must style your way out using CSS. Transform the scenery by applying styles and animations to elements, making them come to life. Learn advanced CSS techniques like transitions, transforms, and animations.</p>
                <h2>What our users think about it?</h2>
                <p>“Styling Secrets is an exceptional game for mastering advanced CSS techniques. The animations and transitions were particularly fun to play with.” - Daniel Harris</p>
            </div>
        </div>
        
        <!-- The container for the fifth game is defined here. -->
        <div class="game">
            <img src="assets/game5.gif" alt="Game 5 Preview">
            <div class = "game-info">
                <h2>JavaScript Jungle</h2>
                <p>Category: JavaScript</p>
                <p class="difficulty">Difficulty: 5</p>
                <p>Rating: <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</span></p>
                <p class="completion-time">Estimated Completion Time: 30 minutes</p>
                <button onclick="showPopup('JavaScript Jungle', 5)">Play</button>
            </div>
            <div class="game-description">
                <h2>What is this game about?</h2>
                <p>Venture through the dense JavaScript Jungle where every step requires logic and programming skills. Solve coding challenges to create paths, control characters, and avoid traps. This game focuses on basic JavaScript syntax, variables, and functions.</p>
                <h2>What our users think about it?</h2>
                <p>“JavaScript Jungle was a fantastic way to get hands-on experience with JavaScript. The coding challenges were well-designed and helped reinforce my understanding.” - Chris Martinez</p>
            </div>
        </div>
        
        <!-- The container for the sixth game is defined here. -->
        <div class="game">
            <img src="assets/game6.gif" alt="Game 6 Preview">
            <div class="game-info">
                <h2>Code Quest</h2>
                <p>Category: JavaScript</p>
                <p class="difficulty"> Difficulty: 6</p>
                <p>Rating: <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</span></p>
                <p class="completion-time">Estimated Completion Time: 40 minutes</p>
                <button onclick="showPopup('Code Quest', 6)">Play</button>
            </div>
            <div class="game-description">
                <h2>What is this game about?</h2>
                <p>Take on the role of a knight on a quest to save the kingdom. Use your JavaScript knowledge to solve riddles, control the environment, and defeat enemies. Explore concepts like loops, conditionals, and event handling in a captivating storyline.</p>
                <h2>What our users think about it?</h2>
                <p>“Code Quest made learning JavaScript a thrilling adventure. The quests and coding tasks were well-balanced and greatly enhanced my problem-solving skills.” - Amanda Wilson</p>
            </div>
        </div>
        
        <!-- The container for the seventh game is defined here. -->
        <div class="game">
            <img src="assets/game7.gif" alt="Game 7 Preview">
            <div class="game-info">
                <h2>Database Dungeon</h2>
                <p>Category: SQL</p>
                <p class="difficulty">Difficulty: 7</p>
                <p>Rating: <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
                <p class="completion-time">Estimated Completion Time: 50 minutes</p>
                <button onclick="showPopup('Database Dungeon', 7)">Play</button>
            </div>
            <div class="game-description">
                <h2>What is this game about?</h2>
                <p>Descend into the Database Dungeon where only your SQL skills can unlock the doors to freedom. Retrieve and manipulate data to uncover hidden passages and treasures. Focus on basic SQL queries, joins, and database design.</p>
                <h2>What our users think about it?</h2>
                <p>“Database Dungeon was an incredible experience that deepened my understanding of SQL. The game’s mechanics were intuitive, making it easy to learn complex queries.” - Robert Johnson</p>
            </div>
        </div>
        
        <!-- The container for the eighth game is defined here. -->
        <div class="game">
            <img src="assets/game8.gif" alt="Game 8 Preview">
            <div class="game-info">
                <h2>Query Quest</h2>
                <p>Category: SQL</p>
                <p class="difficulty">Difficulty: 8</p>
                <p>Rating: <span class="stars">&#9733;&#9733;&#9733;&#9734;&#9734;</span></p>
                <p class="completion-time">Estimated Completion Time: 60 minutes</p>
                <button onclick="showPopup('Query Quest', 8)">Play</button>
            </div>
            <div class="game-description">
                <h2>What is this game about?</h2>
                <p>Set out on a quest to gather ancient artifacts scattered across the realm. Use SQL queries to find and collect the artifacts by navigating through various database challenges. Learn about complex queries, subqueries, and data aggregation in an engaging adventure.</p>
                <h2>What our users think about it?</h2>
                <p>“Query Quest is a brilliant game for anyone looking to master SQL. The challenges were tough but fair, and the storyline kept me hooked from start to finish.” - Linda Thompson</p>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 CodeEscape. All rights reserved.</p>
    </footer>
</body>
</html>
# codescape_website

This repo stores for the files of the full-stack web development project "Code Escape".

## Demo Link
https://youtu.be/4CPrWHfwebA
This is the link to the video description and demo of the website.

## Website Idea
This website was developed as a group university project, and aims to deploy standard foundational web-development tool to create a basic functioning website.

## Website Structure Description
1. Homepage

Includes navigation (different tabs like Home, Games, My Profile, About, and Contact Us), and login box, as well as sign up links. This page has two different versions for logged in and logged out users.
This page has two different versions for logged in and logged out users (My Profile is not displayed in navigation bar for logged out users). Logged in users do not have the opportunity to sign up or log in again, but rather have the buttons to redirect the to the Games page directly and start playing.

2. Signup Page

This would include normal signup process, and additional personality questions (character type, favourite colour, symbol). Based on the answers for the personality questions, we will provide a profile image for each user. Right now we have three possible outcomes of the quiz for three different profile types to be created.
This page is only accessible for logged out users.

3. User Profile Page

Here we show the user’s custom avatar, name, and proficiency level. This adds a personalization and allows users to track their progress. This tab also contains the logout button to end the ongoing section.
This page is only accessible for logged in users.

4. Games Tab

Here the user can access the list of all available games with a brief GIF preview, difficulty levels, and estimated completion time. The games also contain descriptions and user reviews. This helps users decide what to play based on their skill level and available time. The actual game development is out of this group project scope, so the games would not be clickable or playable.
This page has two different versions for logged in and logged out users (for logged out users the games are not playable and the proficiency level is not displayed).

5. About Page

Here we display the business's purpose, creation date, mission, vision, history, and team.
This page has two different versions for logged in and logged out users (My Profile is not displayed in navigation bar for logged out users).

6. Contact Us Page

Here we include a section for Frequently Asked Questions (FAQ) and a form for inquiries, which are saved in our database table “contacts”.
This page has two different versions for logged in and logged out users (My Profile is not displayed in navigation bar for logged out users).

## Files Tree
- assets - folder that contains visual content for the website
- about_us_logged_in.html - html for the logged in version of the "About Us" page
- about_us_logged_out.html - html for the logged out version of the "About Us" page
- contact_us_logged_in.html - html for the logged in version of the "Contact Us" page
- contact_us_logged_out.html - html for the logged out version of the "Contact Us" page
- db.php - the php file that initiates the connection with the database
- games_page_logged_in.php - the html file embedded in php format to allow for php functionality in the "Games" page, logged in version
- games_page_logged_out.html - the html file of the "Games" page, logged out version, php functionality is not needed here
- index.html - homepage html file, logged out version
- index_logged_in.html - homepage html file, logged in version
- login.php - php file that enables login process (check against existing users and their passwords in the database)
- logout.php - php file that allows the user to log out and end the current session
- profile.php - the html file embedded in php format to allow for php functionality in the "Profile" page, only available for logged in users
- signup.js - java script file that validates the input fields during the sign up
- signup.php - html file embedded into php format to allow for the check if such a user with such a username can be created
- signup_quiz.html - the html file of the sign-up quiz, which needs to be completed to finish the sign-up process and create a profile
- signup_quiz.php - the php file that completes the sign-up process through saving the user credentials and quiz outputs in the database
- styles.css - css style sheet
- submit_form.php - php file that enables the submission of the "Contact Us" form

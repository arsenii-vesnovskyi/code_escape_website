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

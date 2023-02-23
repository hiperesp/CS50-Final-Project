# og:preview
#### Video Demo: https://www.youtube.com/watch?v=OkiLleXy50o
#### Description:
This project was created to help users preview their OpenGraph tags before posting to social media.\
It is a web app that allows users to enter a URL and see a preview of the OpenGraph tags for that URL.\
This app allow users to generate the OpenGraph tags for their website.
I wrote it using PHP 8.2 as the main language, using the Slim framework for routing and Twig as template engine. I also used HTML, CSS, and JavaScript for the front-end.\
\
I created a ApiController with target to return the OpenGraph tags in JSON format, but I don't used it in the front-end, because I used twig and it inject the data without api call needed.\
The AppController has 2 routes, one for the home page and another for the preview page.\
The IndexController has 2 childs, AppController and ApiController.\
\
I created a model OpenGraph to handle the OpenGraph tags, extracting the data from the given URL or provided HTML code. It will search for meta tags with "property" og:title, og:description and og:image and extract them.\
\
All the front-end is in the template folder, with the index.twig and preview.twig files inside pages folder and the layout.twig is inside the layout folder.\
\
I think that's all about the project's structure.\
\
About the project, my motivation was to help web developers to create their OpenGraph tags for their websites and redactores to preview their posts before posting to social media.\
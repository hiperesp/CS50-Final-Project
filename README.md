# og:preview
#### Video Demo: https://www.youtube.com/watch?v=OkiLleXy50o
#### Description:
My project is a web application that I created to assist web developers and content creators in generating and previewing OpenGraph tags before publishing content on social media platforms. Opengraph tags play a critical role in determining how a web page is displayed on various social media channels. They provide metadat that social media platforms use to generate previews of a website's content, includint the title, description and image.\
\
As a web developer, I understand the importance of having properly formatted OpenGraph tags on my website, and I wanted to provide a tool that would make it easy for others to create and preview their own tags.\
\
To create the application, I utilized PHP 8.2 as the primary language, along with the Slim framework for routing and Twig as the template engine. The front-end of the application was created using HTML, CSS and JavaScript. The combination of these tools allowed me to develop a user-friendly interface that was both fast and easy to navigate.\
\
One of the key features of my application is the ability for users to enter a URL and see a preview of the OpenGraph tags for that particular web page. This functionality is incredibly useful for web developers, who can ensure that their OpenGraph tags are correctly formatted before publishing their content. Additionally, users can generate the OpenGraph tags for their own website by inputting their image, title and description.\
\
To facilitate the extraction of OpenGraph tag data, I created an ApiController that returns the tags in JSON format. However, since I used Twig for the front-end, the data is injected directly into the templates without the need for an API call.\
\
This API can be acessed free using this format of URL: https://og-preview.deploy.app.br/api/preview-open-graph?url=<URL_TO_PREVIEW>. It returns a structured JSON object with the following properties: "title", "description", "image". It can help other developers to integrate this feature at their websites, such as blogs and it can assist the redactors to preview the Social Media posts before publishing their content.\
\
The AppController is the main controller in my application, with two routes - one for the home page, and can be accessed by "/" and another for the preview page, that can be acessed by "/preview", but it only works with the "url" parameter or "image", "title" and "description".\
\
The IndexController has two child controllers - the AppController and the ApiController. This controller was the controller that separates the frontend from API.\
\
To handle the OpenGraph tags, I created a model called OpenGraph that can extract the necessary data from a URL or provided HTML code. This model searches for meta tags with properties such as "og:title", "og:description", and "og:image" and extracts the relevant data.\
\
All of the front-end templates are stored in the "templates" folder, with the "index.twig" and "preview.twig" files located in the "pages" folder and the "layout.twig" file located in the "layout" folder.\
\
In creating this application, my primary motivation was to help web developers and content creators optimize their websites' appearance on social media platforms. The ability to preview OpenGraph tags before publishing content can save a significant amount of time and effort, and can improve the visibility and engagement of web pages across various social media channels.
# Welcome to Just-A-Blog!

Just-A-Blog aims to be as dead simple as possible. Why? Well, I simply didn't like all of those "simple" content managers that required all sorts of Javascript and Ruby nonsense, and building files offline then converting them to html and blah blah blah.

Just-A-Blog is a small collection of PHP scripts that will run on nearly any web server, and will easily serve up pages and posts you write in Markdown.

# Getting Started

You will probably want to start by editing `pages/home.md`, as this will be your blog's default landing page. Make it short and sweet--or don't! It's probably a good idea to leave &#123;allposts&#125; at the bottom of the page, though maybe you have a reason to get rid of it. Making `pages/about.md` probably wouldn't go amiss.

Put posts in the `posts/` directory. Just-A-Blog will format filenames-with-dashes to Filenames With Spaces to make titles for your posts. The date will be determined by the last edit to the file. This means there are no unpublished or draft modes, and editing a post removes the original date (You may wish to write it down in the original post).

I suppose the next step would be to edit the files in the `html/` directory to adjust the look and feel.

Finally, send an email to just-a-blog@robertdherb.com to let me know you're using it. I'd be excited to see it!

{allposts}

# just-a-blog
A simple blog software that doesn't require a database, and separates content from presentation.

## Features
- Respects the user
-- just-a-blog tries to stay out of your way as much as possible.
-- Doesn't force jquery or any other framework on you.
-- Degrades gracefully for screenreaders or text-only environments
-- You can use your preferred tool for editing pages and posts. 
- Compatible
-- just-a-blog only requires PHP5+. No databases are necessary.
-- Can port existing HTML pages and posts directly into just-a-blog with no need to reformat. (Just remember to change the extension to .md)
- Full customization - Since just-a-blog strives to be small and lightweight, editing it should be extremely easy.

## Install

Installing is dead simple. Simply `git clone https://github.com/robertdherb/just-a-blog` in the directory you serve http pages from. You will also need to make some changes to your httpd to allow it to serve canonical URLs.

## Use

Place markdown files in the posts/ directory. The file name should be the post's title. For instance, a post titled, "My First Post" should be in the file posts/my-first-post.md.

Pages work the same, but are placed in the pages/ directory.

Do not delete pages/home.md. Alter it however you like, but it needs to exist.

Posts are sorted by last edit time. This moves recently edited posts to the top of the list. This may or may not be a desirable outcome for you.

## TODO

 - Make it easier to siwtch cannonical URLs on and off

## Contact
Send an email to just-a-blog@robertdherb.com, or try to find me on Skype (rawbherb) or Steam (abigtimeoperator)

## License
just-a-blog is currently released under the BSD 2-Clause License. See LICENSE for more details.

## Credits
just-a-blog uses [Parsedown](https://github.com/erusev/parsedown) by [Emanuil Rusev](erusev.com).

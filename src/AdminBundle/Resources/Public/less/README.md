# Edit guidlines
File describes basic guidelines how to edit administration less files.
It tries to explain where to find rules and where to add overrides for them.
Main purpose is to have maintainable code.

## Basic description
We use [bowtie 2.0](http://kodovani.com/bp-bowtie/index.html) as core framework for trinity-admin. 
All other edits just overrides basic rules for our purposes.
Rules are split into documents and each (mostly) describe rules for single component.

## Basic rules (steps)
1) Look into [bowtie](http://kodovani.com/bp-bowtie/index.html) documentation first
2) Look into [variables.less](./variables.less) first before applying color, font, gradient or font size. 
Its probably already defined by someone
3) If you creating new rule, always put some comment. (We love to read stories!)
4) If you are not sure. Read this manual or Ask!
5) Think before you commit.

## Where to put new rules?
Before we start, search. Maybe there is already some similar lure in some file.!

Answer is always hard. It little bit about feeling, but mainly its about context.
Ask yourself, what is main component here? For example:
1) you get task to update grid situated inside tabs.
Tab doesn't care about content, so main character here is grid itself. Changes should ho inside grid.less.
2) You get task to update checkbox inside grid which select line. Its same for every grid and every line.
This checkbox is closely coupled with grid, this change should also be inside grid.less

## Old files
Sometimes it can happen that we dont need anymore some component. 
However maybe in future it will be needed again. For such purpose there is **deprecated** directory.
Don't remove rules, just put file here and remove link to in from [admin.less](./admin.less)

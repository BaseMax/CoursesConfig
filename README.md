# PHP CoursesConfig

A php script for parsing an own configuration setting file  and generate HTML page archive.

## Structures

- Course
- Section
- Episode/Lesson

### CoursesConfig

- Split Courses by `===`.
- First line of course is course name.
- Course can have different sections, and section name start with `#`.
- Course can have many lesson or episode, and episode name start with `-`, also in next line there is movie link.
- Sections can have many lessons.

## Deep knowing how works

- You can set default input filename in `src/parser.php` at `$file`.
- You can set directory prefix in `src/parser.php` at `$prefix`.

## Sample Config File

```
Backlink Basics (it's course title)
- Backlink Basics Overview (it's lesson subject)
https://maxbase.org/
- What Are Links? (it's lesson subject)
https://maxbase.org/
- How to Evaluate Links (it's lesson subject)
https://maxbase.org/
# Welcome to Finding Potential SEO Clients (it's section title)
- Introduction to Finding Potential SEO Clients (it's lesson subject)
https://maxbase.org/
# Your Agency's Digital Presence (it's section title)
- Introduction - Your Agency's Digital Presence (it's lesson subject)
https://maxbase.org/
- Provide Value On Your Agency’s Website (it's lesson subject)
https://maxbase.org/
```

Or you can see a complete config file at [input.txt](input.txt) file.

## Using

```
$ php src/parser.php
or
$ php src/parser.php input.txt
or
$ php src/parser.php your-own-filename.txt
```

## Demo of output HTML archive

https://basemax.github.io/CoursesConfig/out/index.html

---------

# Max Base

My nickname is Max, Programming language developer, Full-stack programmer. I love computer scientists, researchers, and compilers. https://maxbase.org/

## Asrez Team

A team includes some programmer, developer, designer, researcher(s) especially Max Base.

[Asrez Team](https://www.asrez.com/)

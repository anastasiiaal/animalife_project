# Animalife 🐈‍⬛🐕

```bash
to start a server
    symfony server start -d

to only build scss
    php bin/console sass:build --watch 
    + uncomment => <link rel="stylesheet" href="{{ asset('styles/app.scss') }}">

to build js + css + scss
    npm run watch / dev

to use Taiwind
    npx tailwindcss -i ./assets/styles/app.css -o ./public/build/app.css --watch
    + uncomment (in base template) => <link rel="stylesheet" href="{{ asset('build/app.css') }}">
```

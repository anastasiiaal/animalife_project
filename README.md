# Animalife

```bash
symfony server start -d
php bin/console sass:build --watch
npm run watch / dev
```
to use Taiwind : 
```bash
npx tailwindcss -i ./assets/styles/app.css -o ./public/build/app.css --watch

+ uncomment (in base template)
    <link rel="stylesheet" href="{{ asset('build/app.css') }}">
```

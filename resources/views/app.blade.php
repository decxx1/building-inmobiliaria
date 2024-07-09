<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">

        <title inertia>{{ config('app.name', 'Building Inmobiliaria') }}</title>

        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
        <script>
			if (
				localStorage.getItem('color-theme') === 'dark' ||
				(!('color-theme' in localStorage) &&
					window.matchMedia('(prefers-color-scheme: dark)').matches)
			) {
				document.documentElement.classList.add('dark');
			} else {
				document.documentElement.classList.remove('dark');
			}
		</script>

    </head>
    <body class="font-Poppins bg-background-light dark:bg-background-dark scrollbar scrollbar-w-3 scrollbar-thumb-rounded-[0.25rem] scrollbar-track-gray-200 scrollbar-thumb-gray-400 dark:scrollbar-track-gray-900 dark:scrollbar-thumb-gray-700">
        @inertia
    </body>
</html>

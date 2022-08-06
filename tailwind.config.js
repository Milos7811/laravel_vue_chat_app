module.exports = {
	content: [
		'./resources/js/**/*.{js,jsx,ts,tsx,vue}',
		'./resources/views/*.blade.php',
	],

    theme: {
        extend: {
            colors: {
                // // 'main': '#cafafe',
                // // 'second': '#96caef',
                // // 'third': '#55bdca',
                // 'four' : '#3feee7',
                // 'five' : '#fc4444',
                'text': '#000000',
                'second-text': '#d7cdcd',
                'theme' : '#29b9f0ff',
                'theme-second' : '#EE5007'
            },
            backgroundColor: theme => ({
                'light' : '#ffffff',
                'light-second' : '#e7e7e7',
                'light-fg' : '#a1a1a1',
                'dark-bg' : '#171717',
                'dark-bg-second' : '#202124',
                'dark-fg' : '#303134',
                'dark-fg-second' : '#3c4043'

            }),
            textColor: theme => ({
                'light-text': '#000000',
                'light-second' : '#666565',
                'dark-text' : '#ffffff'
            })
        }
    }
}

## Update on how to configure the taiilwindcss

Install Tailwindss
![image](https://github.com/LancemDev/for-pyrowatch/assets/74910038/335f1abd-1e05-479d-9985-4ffd38d02134)

This will create a tailwind.config.js file
Edit the content part to locate your html, js files etc. Any file that wants to use taiwlindcss
![image](https://github.com/LancemDev/for-pyrowatch/assets/74910038/ff2e3260-858d-4ff7-b11e-564d35867852)

Add the tailwind directive to your css (create a file and call it input.css where you usually have your css files
![image](https://github.com/LancemDev/for-pyrowatch/assets/74910038/675dd938-d642-47bd-9082-1633e72d38fe)

Start the tailwind build process with the following cli command. Note input.css and its directory. Output.css is where the generated css will be stored so you can as well modify the directory

npx tailwindcss -i ./src/input.css -o ./dist/output.css --watch

After that is done, You can connect the html files via the link tag just as you would for normal css

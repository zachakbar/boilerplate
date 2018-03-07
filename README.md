# Boilerplate

A responsive boilerplate to start basic web pages/sites with.

make sure you have installed both [NPM](https://www.npmjs.com/get-npm) and [gulp.js](https://gulpjs.com/).

it is also a good idea to have the following ruby gems installed:
- compass ``` gem install compass ```
- susy ``` gem install susy ```
- breakpoint ``` gem install breakpoint ```

_if you are on macOS High Sierra you may run into issues with the gem install locations. check out [this stackoverflow article](https://stackoverflow.com/questions/46511870/doesnt-compile-scss-after-update-osx-to-10-13-macos-high-sierra) for a possible solution._

install instructions:
1. navigate to directory you wish to install the boilerplate folder.
```html
cd PROJECT/FOLDER/PATH/
```
2. install the boilderplate-core
```html
git clone https://github.com/zachakbar/boilerplate-core.git PROJECT_NAME
```
3. change folder to the one just created
```html
cd PROJECT_NAME
```
4. install the node modules using the package.json
```html
npm install
```
5. start gulp and begin making magic
```
gulp
```

_tip: make sure to exclude the **node_modules** and **.sass-cache** folder from uploading. you can also remove the **styles.html** and **README.md** if you so choose._

Please create a new [issue](https://github.com/zachakbar/boilerplate-core/issues) for any bugs or potential items you wish to add.

~z

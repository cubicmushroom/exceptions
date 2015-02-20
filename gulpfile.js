var gulp     = require('gulp'),
    bump     = require('gulp-bump'),
    codecept = require('gulp-codeception'),
    git      = require('gulp-git'),
    notify   = require('gulp-notify'),
    shell    = require('gulp-shell'),
    watch    = require('gulp-watch');

var srcFilePattern         = './src/**/*.php',
    unitTestPattern        = './tests/unit/**/*.php',
    testSupportFilePattern = './tests/_support/**/*.php',
    versionFilePattern     = ['./composer.json', './package.json'];


gulp.task('clear', shell.task(
    [
        'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo',
        'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo',
        'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo', 'echo'
    ]
));


/**
 * Codeception tasks
 */
gulp.task('cc:unit', function () {
    var options = {
        //flags    : '--no-colors',
        testSuite: 'unit',
        debug    : false,
        notify   : true
    };
    gulp.src(unitTestPattern)
        .pipe(codecept(false, options))
        .on('error', notify.onError({
            title  : "Unit Tests failed!",
            message: "Errors during runtime <%= error.message %>",
            icon   : './node_modules/gulp-codeception/assets/test-fail.jpg'
        }))
        .pipe(notify({
            title  : 'Success!',
            icon   : './node_modules/gulp-codeception/assets/test-pass.jpg',
            message: 'Everything was successful!'
        }))
});
gulp.task('watch:cc:unit', ['cc:unit'], function () {
    gulp.watch([srcFilePattern, unitTestPattern, testSupportFilePattern], ['clear', 'cc:unit']);
});


/**
 * Version Tagging tasks
 */
/**
 * Bumping version number and tagging the repository with it.
 * Please read http://semver.org/
 *
 * You can use the commands
 *
 *     gulp patch     # makes v0.1.0 → v0.1.1
 *     gulp feature   # makes v0.1.1 → v0.2.0
 *     gulp release   # makes v0.2.1 → v1.0.0
 *
 * To bump the version numbers accordingly after you did a patch,
 * introduced a feature or made a backwards-incompatible release.
 */

function incrementVersion(importance) {
    // get all the files to bump version in
    return gulp.src(versionFilePattern)
        // bump the version number in those files
        .pipe(bump({type: importance}))
        // save it back to filesystem
        .pipe(gulp.dest('./'))
        // commit the changed version number
        .pipe(git.commit('Released updated version'))

        // read only one file to get the version number
        .pipe(filter('package.json'));
        // **tag it in the repository**
        //.pipe(tag_version());
}

gulp.task('version:patch', function () {
    return incrementVersion('patch');
});
gulp.task('version:feature', function () {
    return incrementVersion('minor');
});
gulp.task('version:release', function () {
    return incrementVersion('major');
});
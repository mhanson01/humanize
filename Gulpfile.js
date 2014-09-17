var gulp = require('gulp');
var phpspec = require('gulp-phpspec');
var run = require('gulp-run');
var notify = require('gulp-notify');
 
gulp.task('test', function() {
   gulp.src('spec/**/*.php')
       .pipe(run('clear'))
       .pipe(phpspec('./vendor/bin/phpspec run', { notify: true }))
       .on('error', notify.onError({
           title: 'Red',
           message: 'Failed!',
           icon: __dirname + '/failed.jpg'
       }))
       .pipe(notify({
           title: 'Green',
           message: 'Passed!',
           icon: __dirname + '/passed.jpg'
       }));
});
 
gulp.task('watch', function() {
   gulp.watch(['spec/**/*.php', 'src/**/*.php'], ['test']);
});
 
gulp.task('default', ['test', 'watch']);

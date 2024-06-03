// Requirements 

var gulp = require('gulp'); 
var sass = require('gulp-sass');

// Compile Sass Task

gulp.task('sass', function() {
    return gulp.src('sass/**/*.scss')
        .pipe(sass())
        .pipe(gulp.dest(''));
});

// Watch Changes Task

gulp.task('watch', function() {
    gulp.watch('sass/**/*.scss', ['sass']);
});

// Default Task

gulp.task('default', ['sass', 'watch']);
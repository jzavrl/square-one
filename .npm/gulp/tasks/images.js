/**
 * Task to compress image and SVG files.
 *
 * Tasks:
 * - Compress image and SVG files
 * - Puts to destination
 * - Success/error message
 */

'use strict';

module.exports = function(gulp, $, config, messages) {
  gulp.task('images', function() {
  	return gulp.src(config.images.src)
  		.pipe($.plumber({
  			errorHandler: messages.error
  		}))
  		.pipe($.cache($.imagemin(config.images.config)))
  		.pipe(gulp.dest(config.images.destination))
  		.pipe($.notify(messages.success));
  });
};

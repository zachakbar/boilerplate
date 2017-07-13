# Require any additional compass plugins here.
require 'susy'
require 'breakpoint'

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = "assets/css"
sass_dir = "_source/scss"
images_dir = "assets/img"
javascripts_dir = "assets/js"
fonts_dir ="assets/fonts"

output_style = :compressed
environment = :development

relative_assets = true
disable_warnings = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false
color_output = false

# Disable the createtion of .sass-cache folder, turn this on if you have a large stylesheet. 
# Make sure to not upload this folder if you are using caching.
cache = false

# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass _assets/scss scss && rm -rf sass && mv scss sass

require 'compass/import-once/activate'
# Require any additional compass plugins here.



# Compass is a great cross-platform tool for compiling SASS.
# This compass config file will allow you to
# quickly dive right in.
# For more info about compass + SASS: http://net.tutsplus.com/tutorials/html-css-techniques/using-compass-and-sass-for-css-in-your-next-project/



################################################################################

# 1. Set this to the root of your project when deployed:
http_path = "/"

# 2. probably don't need to touch these, but their paths are relative to this
# file:
css_dir = "css"
sass_dir = "scss"
images_dir = "images"
javascripts_dir = "js"
environment = :development

# 3. You can select your preferred output style here (can be overridden via the
# command line):
# output_style = :expanded or :nested or :compact or :compressed
output_style = :nested

# 4. When you are ready to launch your WP theme comment out (3) and uncomment
# the line below
# output_style = :compressed

# To enable relative paths to assets via compass helper functions. Uncomment:
relative_assets = true

# To disable debugging comments that display the original location of your
# selectors. Uncomment:
# line_comments = false

# don't touch this
preferred_syntax = :scss

# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass sass scss && rm -rf sass && mv scss sass

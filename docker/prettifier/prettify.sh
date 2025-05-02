#!/bin/bash

THEME=css/theme.css

readarray -d '' FILES < <(find ./app -type f -name "*.html" -print0)

for file in "${FILES[@]}"; do
    if [[ ! -f app/$THEME ]]; then
        mkdir -p app/css
        htmlq -f $file -o app/$THEME -- style[id="vuetify-theme-stylesheet"]
        sed -i"" -r "s|</?style.*>||g" app/$THEME
        prettier app/$THEME --write
    fi

    FOLDER=$(dirname $file)
    if [[ "$FOLDER" == "./app" ]]; then
        RELATIVE_DIRECTORY_PREFIX=""
    else
        # Assume that there is at max one depth of html"
        RELATIVE_DIRECTORY_PREFIX="../"
    fi

    CSS_PATH=$RELATIVE_DIRECTORY_PREFIX$THEME

    echo "<!DOCTYPE html>" > app/temp
    htmlq -f $file -r style[id="vuetify-theme-stylesheet"] >> app/temp
    sed -i"" -r "s|^$|<link crossorigin=\"\" href=\"$CSS_PATH\" rel=\"stylesheet\">|" app/temp
    mv app/temp $file
done

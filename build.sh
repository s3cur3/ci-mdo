#!/bin/sh

echo "\n\n\nDeleting all hidden files..."
find assets -name '.*' -type f -delete
find docs -name '.*' -type f -delete
find lang -name '.*' -type f -delete
find lib -name '.*' -type f -delete
find templates -name '.*' -type f -delete

echo "\n\n\nRunning grunt task..."
grunt

echo "\n\n\nBeginning premium version build"
ZIP="ci-modern-doctors-office.zip"
echo "Nuking existing ZIP"
rm ${ZIP}

echo "Creating build directory"
DIRECTORY="ci-modern-doctors-office"
mkdir $DIRECTORY

echo "Copying files to build directory"
cp -r assets docs lang lib templates style.css README.md screenshot.png 404.php archive-ci-staff.php base-template-landing.php base.php functions.php Gruntfile.js index.php options.php page.php single-ci-staff.php single.php template-blog.php template-landing.php template-staff.php screenshot.png $DIRECTORY

echo "Zipping build directory"
zip -r ${ZIP} ${DIRECTORY}

echo "Nuking build directory"
rm -rf ${DIRECTORY}



echo "\n\n\nBeginning free version build"

ZIP="ci-modern-doctors-office-free.zip"
echo "Nuking existing ZIP"
rm ${ZIP}

echo "Creating build directory"
DIRECTORY="ci-modern-doctors-office-free"
mkdir $DIRECTORY

echo "Copying files to build directory"
cp -r assets docs lang lib templates style.css README.md screenshot.png 404.php archive-ci-staff.php base-template-landing.php base.php functions.php Gruntfile.js index.php options.php page.php single-ci-staff.php single.php template-blog.php template-landing.php template-staff.php screenshot.png $DIRECTORY

echo "Nuking premium version files"
rm -R ${DIRECTORY}/lib/premium

echo "\n\n\nZipping build directory"
zip -r ${ZIP} ${DIRECTORY}

echo "\n\n\nNuking build directory"
rm -rf ${DIRECTORY}

osascript open-docs.scpt

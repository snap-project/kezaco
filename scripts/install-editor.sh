#!/usr/bin/env bash

rm -rf web/editor

editor_path="$(readlink -e vendor/snap-project/app-builder)"
editor_deps_override_path="$(readlink -e web/bundles/kezacoeditor/js/app-builder-deps.js)"
angular_module_path="$(readlink -e  web/bundles/kezacoeditor/js/editor)"

# Expose editor
ln -fs ${editor_path} web/editor

# Override editor deps
ln -fs ${editor_deps_override_path} web/editor/js/deps.js
ln -fs ${angular_module_path} web/editor/js/kezaco

# Install editor deps
cd web/editor
bower install

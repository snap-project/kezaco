#!/usr/bin/env bash

editor_path="$(readlink -e vendor/snap-project/app-builder)"
ln -s ${editor_path} web/editor
cd web/editor
bower install

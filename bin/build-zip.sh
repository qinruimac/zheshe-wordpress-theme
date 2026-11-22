#!/bin/sh
# 打包 WordPress.org 投稿 / 后台上传用的主题安装包（顶层目录为 zheshe/）。
# 产物名带版本号：zheshe_v<VERSION>.zip，VERSION 自动读取 style.css 的 Version 头。
# 用法：在任意目录执行 sh bin/build-zip.sh
set -eu

ROOT=$(cd "$(dirname "$0")/.." && pwd)
VERSION=$(grep -i '^Version:' "$ROOT/style.css" | head -1 | sed 's/.*: *//' | tr -d '\r' | tr -d '[:space:]')
if [ -z "$VERSION" ]; then
    echo "Cannot read Version from style.css" >&2
    exit 1
fi
OUT="$ROOT/zheshe_v${VERSION}.zip"
STAGE=$(mktemp -d)
trap 'rm -rf "$STAGE"' EXIT

mkdir "$STAGE/zheshe"

# 复制时显式排除开发文件（不依赖 .gitignore，未跟踪的本地文件同样会被排除）
tar -C "$ROOT" \
    --exclude='./.*' \
    --exclude='.DS_Store' \
    --exclude='Thumbs.db' \
    --exclude='desktop.ini' \
    --exclude='./bin' \
    --exclude='node_modules' \
    --exclude='*.zip' \
    --exclude='*.log' \
    -cf - . | tar -C "$STAGE/zheshe" -xf -

rm -f "$OUT"
(cd "$STAGE" && zip -rqX "$OUT" zheshe \
    -x '*/.*' '*.DS_Store' '*/node_modules/*' '*.zip' '*.log')

echo "Built $OUT"

<?php
if (time() < mktime(0, 0, 0, 5, 1, 0) || time() > mktime(0, 0, 0, 9, 30, 0)) {
    if (date('w', time()) >= 1 && date('w', time()) <= 5) {
        echo '上午 9：00-12：00   下午 14：00-18：00 (法定节假日除外)';
    }
} else {
    if (date('w', time()) >= 1 && date('w', time()) <= 5) {
        echo '上午 9：30-12：00   下午 13：00-18：00 (法定节假日除外)';
    }
}
<?php
$config = array (
    //应用ID,您的APPID。
    'app_id' => "2016100100643058",

    //商户私钥，您的原始格式RSA私钥
    'merchant_private_key' => "MIIEowIBAAKCAQEAr4y7zZfeySIROC1Ds/MTiwYi2rFjvD0Hyzot0SFTRM2GijMm3SFz38bEaAd9Z/iyGklCajKhW9Glob2zuZRzTQNSXF9DTNAZUN7JyT1x18fB0zcxTvfXcF/9JGKYkkerhYwwhDkOqtSJolN114gKJSM+HzQB6rBl7vIcuvsR7Dh+NRZz/OI+swOQLsmLyHzjgr4oOyxRr2qWScYmtdwZqwJDpByZ9IxWcQEPojTEsuuPLZjSPiw25cEOSJ3EPjHyCmVXdfnPIPPus0SiXlC2wXh/k4VLWp7lF29nyRz4hE199WKtBs41d6t8OPPWQdeds+ON2vho45pYhkbmZkvaIwIDAQABAoIBAQCYo63IHf1AtbZzOihcF0cu4q77qLInwok8U+HyrR9R+8K397IbJDM0qAeuzJRmCwARixGMdWmIBMoX0HKtMj7u/6xlVQ+XgnoArzaVHDAYh0Ao/xyIpUdWFqBtOq2ew2KIRFULIvF16EekNR2JwmfP0sz5JKdmAOsg0LPagOQcl7G7t6AV3Odj8rcA6S46pDrCFevDjJpbuErp0+RytxR5ylmSQrbNduQ9Eb3PqqlSWHf9G5fc9qVpNevrr8pkBSRJGHejoEPi8lBAMSyoX2n0cRbdGUtbr+Sdb56HRLxuGdkNWPil9Cn2xozYhuUFfbj45zF2Yi7s15Bb90XL4bbBAoGBANUVBjRlOoLDZ5yaBG28rQgYbr1NWyrRCaJYe/DGRmMoJ7/5VPVqjLqKGb0XM3+y14nWLYk8b5kFmXLLmBBk/jvcdseL0dzAHdRDHQxvTBAurZigMoh1+bCci221SkxLAxMdXocrHPDRfEEofShdgPlqT0ACcr8UPW+uOCix31k/AoGBANLodVSOgQoHklefHq75gepEGmFKXFIRJmCB6t6uFiE/r+kRnuHQ2K2sp3G7hY9WZdh2ooCjpx0s6EtMmDPHBLye3qMyLhg+l/wX86F2oxlriFOa39v+JeeLcJeJAiH8c8CHNtUIvU7zYZD3AFcTzYB/WDzknhQf6TtGNw7FY8IdAoGAeaekQDvfWRMJT96bUq/bNnkEmK3WtC5eysKsGH6LZ0dg0nke6XMo38PDCDN74peP+ZE/tE++A2awAlt8+Tc/85tecXVBn0BMh4i9yACvM7oCwNYNo91/bjciX8OWpNJa8gndk1ypDFD+GRFty6L+5OeuUYRUUQXUQbP9Oja7pu8CgYAZ3hT15/x/pGoYgRWcVFHQz8WEhUBJeH0CfSy3XxarwUnsBhM8kwbgVjq7QkqhR/F52SMZL/lBJM7g3WYVg6VbFQktbuwkYRj2/GEPPqPGbF/uESK/sq4ndfy7OTyfunzf8jWRb174nfUreH/8LhuYVQYXgdq5kShj8rqx/xe7KQKBgAtNsQOOtKp8Yutvs43WK1vMRxIDwYaXk03L2fh3DD6+wShNqGq/VxUnJ1Ehk/JYvjmwnIJeEHhew/gQ7PiAX9tLV0k/Irs/uZiiGsK76VQznGkSDWFzaoVda6vjHzQPf7xT5OyP7/LVy7pX2Bq2jeCvlfRHJnk8Lxoi7LiPBnrc",

    //异步通知地址
    'notify_url' => "http://114.115.175.207:80/ccxm/upload/payapi/alipay/payend.php",

    //同步跳转
    'return_url' => "http://114.115.175.207:80/ccxm/upload/payapi/alipay/npayend.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnO/Cp0XbpuED6L7xDGA8f7UP5qG0YUboYcJAC1th7qUUP+tfQBuuTSNbg4loBwbYgwVXASb6D6wOJH+J6HvgX7WhxvRdFEYHhc56ImP8AHFiWq7/f+UgzQUfKWMvFsfsbxCdDTqhs18rLD1Blkxp/2ay7Qjzo6bewFd+Jyk0U5YHra+7E4jP5oGp8ijUpW8Kn6g9xdXSvkLARCLOteH3o1wTbz7wUnu+qcOIUwCTn1ZEuOywIc2Sk/BHVUGItvpPCjTsuBc+I7JG5SycSMYVwtmSBqkBfqm1HVP7VZdIgH2JsJX9XVD+w1UdbM9k9vOJ4cUUfwFo6fqrVbf/G7YuLQIDAQAB",


);
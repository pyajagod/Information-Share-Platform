<?php
$config = array (
    //应用ID,您的APPID。
    'app_id' => "2019092767836582",

    //商户私钥，您的原始格式RSA私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEAyz4wB++DGCN9Z/VmW1G1cYdv6Qa+mEpDoXjCwVMV0b4dZUyo8KrWYnfzv8pihpGbtOVjmuXewXUFjbd2xxAK1/pE+cDZib1D4+MfIbUgS0lKt124/9RTbb7WEnWtF2O7T2sNKhBttjb76NduSRrBV+trK+ZyuvqxHFfKbzjHr0sg9AkUsNEwyxpXHfFzvOVd/zFQYgVbH/rPVGrwMbeDuU+HZKY4hMqK27oUioC0Pt2yST79e7Kvb2pNFZ/fbEo9mk/+4QmvM7JxOArGTO7l3+s3qdhgCVcuvaQpDWVOibqr5x78VICz1r8Scp8bQXN+/Up23aji6Bu1s8uWquhkBQIDAQABAoIBAEl3n1EfCRpOqeRMVsWn0ZjKRm/LmlXecngJ+Qx9BiQdPu8BOQhWGMzbY2but5LBS7GmQc0aTt1LechyiyMF74WG2CwXxAsAOWxFC1nZ6WSNh86kuFzx2X6QPz3I/9q2mFzq64VLDv2Q/pp6VUljvIQVe1YRJWPlfuQp7+koczYvopg03s4oG5XsylIX1HY0DRi+niMV9mXtdEMlFY7I3MBEgc2gjbaKBrOn5QADl9TY8Gww6oHikuLG24XM2gYjTN2lfITaX+B1gmnG/hROUW2lbs183EqCiYDl6/OsvupbDbkvMpWfu366Tm8ysjKfu7zwQMoP31FGL8Uq/ZiYfzkCgYEA+VEsrqLezei3yril4qzCkgks816pInhQhkpm7kNVX7bgj/dGvZ006EMxe193g+8SafS/jq820i7An2/gxL6MZieskfvd8nlmaSk8bkoAyNX4GGEavNXdYyQmQtg77lqPJSzHU/RZAj4tgTvEnrFO+DPxxoppk9qTELDSvDvmXOcCgYEA0LDZmYY7aux+266wiMNzAh0CUn21HnvADArM/wPRg840Pp4KWwk3ZCkob+61gb4pJ0tBOXjaebZjiuMv0LXEYRvyZUivzaQsJMRV9rg2IQ8mJPraXOcF/tPJcoU07plEHtWFXuJd7dM0mW6wHGqaPvB3FDFwLm1echl77L5uzjMCgYEAzXwhBqKIXk+jQ7siRgw7pV9YpBFt91IQlE44PcJTWDsDJMUakedDFvdijhumBqCBncCyLSiuV1dfPUlZiO7ACuZCLmPXjySNyrjI7OGjeeQYwgcuoVrnR/IgctGDu7T57BrXApQO1HFo0e3v5RegTaOKbyffUpRAx+3lEm2QNRsCgYBWClPspBcjQlYbJK7L9CkamfM3J3ThGIxZaqqSCXT8LqwDlQ0X83jO5tkxLO3QjCJTfQdrNpR80eHAhWJVXluU3fzWHV2+Hw3EKt52VgSbJK/JV1NoMieapJ7NhHYKWU5omAfg0tt/DjEFgUlCrgDiKiouPSPPQHBMAo3BUdJFWQKBgQDUDKtyycaVjau/DOxY5mBAKaNoT+iltj1lv4R68vdPUGg8klzGYcL+SWaw6B6DwouEPsr7cefgGc2p8FNdc5qMjzu6l9NRH425Df06ovfrXNQ5dWUH3ZraiQR0T2/OOlV/GPEtKp9d6VXmOxI4rSsSXhwHWgiJwf5sHXHpamHD/A==",

    //异步通知地址
    'notify_url' => "http://114.115.175.207:80/upload/payapi/alipay/payend.php",

    //同步跳转
    'return_url' => "http://114.115.175.207:80/upload/payapi/alipay/npayend.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA1k+xj/8p5ENzfRSny2ouCsl89ps63y6g6JGkuQm67dDYSX4TM3Ly3Nv2S9cs7WTUCneJDDAFlRk3aS+Ikhd+jQV5eYjP5QLAmZjCn4m1WKiTdEXqzg/RLSiME+1p9QqSSmywRV1ezOtgteAUbPEwY0yY7SPhTLxc6ziCiBNETrqDaHJicgbLydRLLf7Fd5acRb+0tmlTv6jwZilxIJlRLbMnVNSkLiG7VQPt3KIVT/fygtqWR52anv1wFkXFD95ipw4Ae4/3tNdfh02OU4OJyzkwxXLgVoGfQeKZan9aE+hGu1Z4vQA462J/pQLLx4YYfno8qhjU/ErB7IVKQ51JewIDAQAB",


);
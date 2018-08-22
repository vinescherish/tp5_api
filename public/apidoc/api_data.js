define({ "api": [
  {
    "type": "get",
    "url": "/api/member/detail",
    "title": "用户详情信息",
    "version": "1.0.0",
    "name": "detail",
    "group": "member",
    "description": "<p>用户详情信息</p>",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "token",
            "defaultValue": "eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJpc3MiOiJodHRwOlwvXC93d3cuYXBpLmNvbSIsImV4cCI6MTUzNTAyOTgzOSwibWVtYmVyIjp7ImlkIjoxLCJ1c2VybmFtZSI6ImFkbWluIiwidGVsIjoiMTMyOTAwMjI5MzAiLCJjcmVhdGVkX2F0IjoiMjAxOC0wNy0yOCAwNzowMzo0OCIsInVwZGF0ZWRfYXQiOiIyMDE4LTA4LTEwIDE2OjM0OjQ0IiwibW9uZXkiOiI5OTk0ODY1IiwiamlmZW4iOjIxODAxfX0.",
            "description": "<p>令牌</p>"
          }
        ]
      }
    },
    "filename": "application/api/controller/MemberController.php",
    "groupTitle": "member",
    "sampleRequest": [
      {
        "url": "http://www.api.com/api/member/detail"
      }
    ]
  },
  {
    "type": "post",
    "url": "/api/member/forget",
    "title": "忘记密码",
    "version": "1.0.0",
    "name": "forget",
    "group": "member",
    "description": "<p>忘记密码</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tel",
            "description": "<p>用户电话</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sms",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "newPassword",
            "description": "<p>再次输入密码</p>"
          }
        ]
      }
    },
    "filename": "application/api/controller/MemberController.php",
    "groupTitle": "member",
    "sampleRequest": [
      {
        "url": "http://www.api.com/api/member/forget"
      }
    ]
  },
  {
    "type": "get",
    "url": "/api/member/login",
    "title": "用户登录",
    "version": "1.0.0",
    "name": "login",
    "group": "member",
    "description": "<p>用户登录</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "defaultValue": "admin",
            "description": "<p>用户名</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "defaultValue": "111111",
            "description": "<p>密码</p>"
          }
        ]
      }
    },
    "filename": "application/api/controller/MemberController.php",
    "groupTitle": "member",
    "sampleRequest": [
      {
        "url": "http://www.api.com/api/member/login"
      }
    ]
  },
  {
    "type": "post",
    "url": "/api/member/reg",
    "title": "用户注册",
    "version": "1.0.0",
    "name": "reg",
    "group": "member",
    "description": "<p>获取短信验证码</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>用户名</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>用户密码</p>"
          },
          {
            "group": "Parameter",
            "type": "vachar",
            "optional": false,
            "field": "tel",
            "description": "<p>电话号码</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "sms",
            "description": "<p>验证码</p>"
          }
        ]
      }
    },
    "filename": "application/api/controller/MemberController.php",
    "groupTitle": "member",
    "sampleRequest": [
      {
        "url": "http://www.api.com/api/member/reg"
      }
    ]
  },
  {
    "type": "post",
    "url": "/api/member/sms",
    "title": "获取短信验证码",
    "version": "1.0.0",
    "name": "sms",
    "group": "member",
    "description": "<p>获取短信验证码</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "vachar",
            "optional": false,
            "field": "tel",
            "description": "<p>电话号码</p>"
          }
        ]
      }
    },
    "filename": "application/api/controller/MemberController.php",
    "groupTitle": "member",
    "sampleRequest": [
      {
        "url": "http://www.api.com/api/member/sms"
      }
    ]
  },
  {
    "type": "any",
    "url": "/api/shop/index",
    "title": "店铺分类",
    "version": "1.0.0",
    "name": "__",
    "group": "shop",
    "description": "<p>获取所有店铺分类</p>",
    "filename": "application/api/controller/ShopController.php",
    "groupTitle": "shop",
    "sampleRequest": [
      {
        "url": "http://www.api.com/api/shop/index"
      }
    ]
  },
  {
    "type": "get",
    "url": "/api/shop/goods",
    "title": "店铺详情信息",
    "version": "1.0.0",
    "name": "goods",
    "group": "shop",
    "description": "<p>接口详细说明</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "defaultValue": "6",
            "description": "<p>店铺ID</p>"
          }
        ]
      }
    },
    "filename": "application/api/controller/ShopController.php",
    "groupTitle": "shop",
    "sampleRequest": [
      {
        "url": "http://www.api.com/api/shop/goods"
      }
    ]
  },
  {
    "type": "get",
    "url": "/api/shop/lists",
    "title": "商家店铺接口",
    "version": "1.0.0",
    "name": "lists",
    "group": "shop",
    "description": "<p>商家店铺接口</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "defaultValue": "2",
            "description": "<p>商铺分类id</p>"
          }
        ]
      }
    },
    "filename": "application/api/controller/ShopController.php",
    "groupTitle": "shop",
    "sampleRequest": [
      {
        "url": "http://www.api.com/api/shop/lists"
      }
    ]
  }
] });

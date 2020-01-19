# 所有顧客

* URI - /customers
* 方法 - GET
* 參數 -
    * page - 從指定 primary key 的下一筆開始顯示

* Sample Request
        GET http://localhost:8080/customers/

* Sample Response
```json
{
    "current_page": 1,
    "first_page_url": "http://localhost:8080/customers?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8080/customers?page=1",
    "next_page_url": null,
    "path": "http://localhost:8080/customers",
    "per_page": 20,
    "prev_page_url": null,
    "to": 13,
    "total": 13,
    "data": [
        {
            "uuid": "0wC2xIR2CruQPNImeA",
            "name": "Julius Champlin",
            "phone": "+514581462",
            "email": "bayer.jermain@yundt.com",
            "gender": 0,
            "birth": "1980-03-03",
            "avatar": "",
            "line": "",
            "fb": "",
            "note": "Ut ipsum repellendus et molestiae. Et aut et recusandae et.",
            "created_at": "2020-01-19 14:16:21",
            "updated_at": "2020-01-19 14:16:21"
        },
        {
			// Result Object, ....
        }
    ]
}
```

* 回傳
- current_page: 當前頁數
- first_page_url: 第一頁連結
- from: 從第幾頁
- last_page: 最後一頁頁數
- page_page: 一頁顯示幾筆資料
- next_page_url: 下一頁連結
- total: 總共幾頁

var json = {
    "a(test)" : "one", "b":2, "c":3
} 
console.log(json)

json["A"] = json["a(test)"];

delete json["a(test)"];

console.log(json.A)
Variable (`var`) is mutable
Constant (`val`) is immutable
Kotlin is **strong-typed**, so initialisation without assigning a value MUST give types. Once done, a variable does not change types.
```Kotlin
var canChange: Int = 42
val cannotChange: Int = 42

cannotChange = 2 //not happening
canChange = "Hello" //not happening
var haha //not happening
var haha : String
```
A variable by default cannot be null, but you can declare them to be **nullable**:
```kotlin
var nickname : String? = "Donggaiyi"
nickname = null //all g
print(nickname) //not happening, could be null, compiler no happy
if (nickname != null) {print(nickname)} //now yeah, OR
print(nickname?.length) //null, as nickname is null, length is null
print(nickname?.length ?: 0) //0, if after wrapping it is null, do the default value, it is like the if thing.
print(nickname!!.length) //forcably

// Can also be done with Scoping function, introduced at the end the Class part
nickname?.let{
	// Inside this block everything is safe, and refer the nickname with "it"
	println(it)
	println(it.length)
}
```
Arrays are **mutable** and **fixed-size**
```kotlin
val arrayOfNum = arrayOf(1,2,3,4)
// OR
val arrayOfNum2 = Array(4, {i->i+1})
arrayofNum.size
arrayofNum[0] = 42
```
Lists can be mutable if used `mutableList`, not fixed size.
```kotlin
var listOfNum = listOf(1,2,3,4)
listOfNum[0] = 100
listOfNum.add(7)
listofNum.average()
var indexOfVal : Int = listOfNum.index(100) //0
var smallerThanThree : Int = listOfNum.count { x -> x < 3 } //2
```
Maps (KV pairs)
- Key and Values can be any type, but must be same for all keys in one map.
- Key must be unique.
- Has mutable versions (`mutableMap`)
```kotlin
val houses = mapOf (
	"G" to 150,
	"S" to 149,
	"H" to 148,
	"R" to 147
	// Commas if not last
)

var G_score = houses["G"] //150
house["G"] = 151 //not happening

val primes = mutableMapOf<Int, Boolean>()
primes[1] = false
primes[3] = true
primes.getOrDefault(2, false) // If 2 is there, get value, if not, use given value "false"
primes.remove(3)
```
Printing is now Logging (`Log.d(TAG, message)`)
```kotlin
Log.d("DONGYI", "Some Message $myname ${G_Score+1}"+someString)

"""
Log also has i, e, w, lots of types.
""".trimIndent()
```
If is the same thing, it's just the ternary:
```kotlin
var IQ = if (name=="Dongyi") 0 else 100
```
There are only ForEach with only the key word being For, but you can also indices
```kotlin
for (i in 0..5) {
	// Both sides inclusive
	print(i) // From 0 to 5
}
for (num in arrayOfNum) {
	print(num)
}

// Indices
for (i in arrayOfNum.indices){
	val num = arrayOfNum[i]
	print(num)
}
```
While and Do...While is the same elsewhere, but
When..Else is not the "switch":
```kotlin
var name = "Dongyi"

when (name){
	"Dongyi" -> print("Wa, stupid!")
	"Sachin" -> print("Smart Boy")
				print("Way smarter than Dongyi")
	"Yifei", "Alex" -> print("Cute!")
	else -> print("Who are you?")
}
// OR
var message = when (name){
	"Dongyi" -> "Wa, stupid!"
	"Sachin" -> "Smart Boy"
	"Yifei", "Alex" -> "Cute!"
	else -> "Who are you?"
}
//Remember else is optional
//And omitting the parameter is possible
var age : Int = 18
var message = when{
	age > 18 -> "So old"
	age = 18 -> "Good"
	age < 18 -> "Prob A minor"
}
```
Function's return type are at the back:
```kotlin
fun myFunction(parameter1 : Int, parameter2 : String): Int{
	//Do my stuff
}
```
Classes are same, having properties (variables/constants) and methods (functions), it is always being referred (pointer), and use dot donation to call it's contents.
```kotlin
class Movie{
	var title : String = "A Movie"
	private var yearPublished : Int = 2020
	var lengthInMinutess : Float = 10000F
	fun lengthinHours : Float{
		return lengthInMinutes / 60F
	}
}

var movie = Movie()
print(movie.title)
print(movie.lengthInMinutes())

// OR, you can use a data class
data class Movie (var title : String, var yearPublished : Int, var lengthInMinutes : Float)
```
Inheritance also happens, the abstract class is called "open class".
```kotlin
open class Animal(){
	fun move(){
	}
}
class Dog() : Animal(){
	fun bark(){
	}
}
class Dongyi() : Animal(){
	fun beingStupid(){
	}
}
```
There are also something new called Scoping functions, it basically can let you quickly boost actions for a class.
- Use `obj.apply() {}`
- Or `with(obj) {}`
- `obj.let() {}` and `obj.also {}`
```kotlin
var cookie = Dog()
with(cookie) {
	bark()
	bark()
	name = "cookie"
	move()
	bark()
}

cookie.apply {
	bark()
	move()
	name = "naughty"
}
```
**The Framework:**
- Applications
- Framework
- Middleware
	- Native Libraries
	- Android Runtime
- Hardware Abstract Layer (HAL)
- Linux Kernel

**Package Files:**
- .`apk`: Binary files with all possible architectures.
- .`aab`: Binary for certain architecture, the one Play Store has.

**Components:**
- Activities
	- Represent a building block(s) of UI
	- A single screen, usually
	- All activities are subclasses of the `Activity` base class
	- Put in Layers:
		- Task / Application
			- Activity
				- ViewGroup
					- ViewGroup
						- View
						- View
					- View
- Services
	- Run in the background to perform long-running operations
	- No user interface
	- Does not block user interaction
- Content Providers
	- A specific set of the app data available to other applications. Like your data can be in SQLite or Firebase, or you can pull up system cameras if app needs a photo intake.
- Broadcast Receivers
	- Receive system-wide announcements
	- "Battery too low, no cam for you"

**`AndroidManifest.xml`:** The manifest file with settings and permissions, always structured.
But now settings are gradually moving to:
**Gradle Files (`build.gradle`):** The config files, their is one for the Module, and one for the whole application. They manage specific things like SDK version, dependencies, build configs.

**Intents**
- Handles navigation in Android
	- Glue/Link between activities, so screens.
	- Send between screens
- Types
	- Specific: Requesting a specific activity to be launched
	- Generic: Open user's camera
- Launched by `startActivity()` and so on.
- Also can be used in the Manifest file to determine which activity is the start-up.
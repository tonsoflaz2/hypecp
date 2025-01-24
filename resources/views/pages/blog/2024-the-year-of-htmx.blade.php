@extends('shell')

@section('title')
	2024: The Year of Htmx
@endsection

@section('styles')
	<style>
		#post a {
			font-weight: bold;
			color: rgb(59 130 246);
		}
		#post a:hover {
			color: black;
		}
	</style>
@endsection

@section('sidebar')
	<div style="margin: 15px; height: 320px; width: 320px;" class="flex border shadow bg-white rounded-lg items-center text-center" src="/images/logo.png">
		
		<div class="mx-auto transform -rotate-12 text-blue-400 font-black text-8xl">
			hype<br>
			<span class="text-gray-900">cp</span>
		</div>
	</div>

	@include('pages.blog.posts')
@endsection


@section('main')

<div id="post" class="p-8 text-gray-600">
    <h2 class="text-4xl font-bold text-black">
    	# 2024: The Year of Htmx
    </h2>
   	<div class="px-6">
	    <div class="text-sm text-gray-400">
	    	January 24, 2025 by Lazarus Morrison
	    </div>
	    <p class="py-3 mt-8">
	    	First of all, let me start with some background.<br><br>
	    	I am a full stack Laravel developer who has been running my own company (Fluency Software) since 2014. I have one employee/partner (in a non-technical role) and I hire a mix of contractors as needed. Basically, I make my living with a mix of:
	    	<ul class="list-decimal pl-8">
	    		<li>Client work on sites I built</li>
	    		<li>Licensing my products to clients</li>
	    		<li>My own SaaS (<a target="_blank" href="https://communityfluency.com">Community Fluency</a>)
	    		</li>
	    	</ul> 
	    	<br>
	    	I track my time to the minute, as I have since 2014 (using <a target="_blank" href="https://toggl.com">Toggl</a>, which makes it easy). So let's start with some graphs and numbers.
	    </p>
	    <div class="text-3xl font-bold text-black mt-12">
	    	Time and Money 2024
	    </div>
	    <div class="flex mt-4">
	    	<div class="pr-8">
	    		<div class="">
	    			<b>Time</b> spent in 2024
	    		</div>
			    <img class="border shadow" width="300" height="300" src="/images/time.png" />
			</div>
			<div class="">
				<div class="">
	    			<b>Revenue</b> sources in 2024
	    		</div>
			    <img class="border shadow" width="300" height="300" src="/images/revenue.png" />
			</div>
		</div>	
		<p class="py-3 mt-4">
			So the goal for the past 5 years, since I launched the SaaS, has been to grow that <b class="inline-block bg-red-500 text-white transform -rotate-12 px-2 rounded">RED</b> portion of the pie chart (my SaaS) to basically provide enough of an income that the client work is purely optional.<br><br>

			That is still the primary goal, but as you will notice the <b class="inline-block bg-green-500 text-white transform -rotate-12 px-2 rounded">GREEN</b> is still the majority of the revenue graph.
			<br><br>

			The completely new thing this year was the <b class="inline-block bg-yellow-500 text-white transform -rotate-12 px-2 rounded">GOLD</b> section - Hypermedia and htmx. 
			<br><br>
			The time graph doesn't even show the whole story &mdash; htmx made its way into my client projects and my SaaS.
		</p>

		<div class="text-3xl font-bold text-black mt-8">
	    	Embracing htmx
	    </div>
	    <p class="py-3 mt-4">
			I came across <a target="_blank" href="https://htmx.org">htmx</a> at the end of 2023, and it really clicked (I have a live post of that experience <a target="_blank" href="/blog/discovering-htmx">here</a>). I decided to go all in using htmx in my projects. <br><br>

			There weren't a ton of resources to learn about it &mdash; so I decided to create my own.
			<br><br>
			First, I bought a nice <a target="_blank" href="https://www.amazon.com/Rode-NT-USB-USB-Condenser-Microphone/dp/B00MMKQOEM">mic</a> and signed up with transistor.fm to create the <a target="_blank" href="https://hx-pod.transistor.fm">hx-pod</a> podcast. As I learned and incorporated htmx into my projects, I recorded episodes.
			<br><br>
			After a few months, I started doing interviews with htmx developers to get an idea of what their experience was. After an off-hand comment from Anthony Alaribe, I also started the <a target="_blank" href="https://youtube.com/@hypermedia-tv">hypermedia-tv</a> youtube channel to post the interviews, which is now at about 500 subscribers (!). 
			<br><br>
			Creating content was something entirely new for me, and some of the most fun I had was doing the conversations. 
			<br><br>
			Some of my personal highlights:
			<ul class="list-disc pl-8">
				<li>Posted <b>95</b> podcast episodes and <b>20</b> youtube videos</li>
				<li>Went to Big Sky Dev Con (my <a target="_blank" href="https://hx-pod.transistor.fm/episodes/big-sky-dev-con-2024">recap</a>)</li>
	    		<li>Interviewed htmx creator <a target="_blank" href="https://www.youtube.com/watch?v=lSTTGD2FywU">Carson Gross</a>, had some corny fun <a target="_blank" href="https://x.com/htmxlabs/status/1815390639300792687/video/1">editing</a> it</li>
	    		<li>Talked to some of my favorite voices in the hypermedia world -- including but not limited to the creators of <a target="_blank" href="https://www.youtube.com/watch?v=HbTFlUqELVc">Datastar</a>, <a target="_blank" href="https://www.youtube.com/watch?v=bH2JflLEGy0">Hyperview</a>, and <a target="_blank" href="https://www.youtube.com/watch?v=7iJOARa0Kys">Unpoly</a></li>
	    		<li>Had some fun creating several <a target="_blank" href="https://www.youtube.com/watch?v=SU3_1bYGI9o">despicable</a> <a target="_blank" href="https://hx-pod.transistor.fm/episodes/building-production-apps-using-htmx-a-conversation-with-tom-from-reddit">htmx</a> <a target="_blank" href="https://hx-pod.transistor.fm/episodes/a-conversation-with-the-ceo-of-htmx">characters</a></li>
	    		<li>Starting to build <a target="_blank" href="https://hypecp.com">hypecp.com</a> in public</li>
	    		<li>My wife creating this thumbnail for me:</li>

	    	</ul>
	    	<a target="_blank" href="https://youtu.be/xUfICrkBco4"><img src="/images/100-year.png" class="ml-8 w-1/2 rounded-xl"></a>
	    	<br><br>
	    	This new and shiny and fun hypermedia adventure came out of nowhere and took up a shocking <b class="inline-block bg-yellow-500 text-white transform -rotate-12 px-2 rounded">23.8%</b> of my time. 
	    	<br><br>
	    	Next it's time to look at what took the highest portion of my time and the <b>majority</b> of my income.
		</p>

		<div class="text-3xl font-bold text-black mt-8">
	    	Client Work
	    </div>
	    <p class="py-3 mt-4">
	    	I have two kinds of client work I do: 
	    	<ul class="list-decimal pl-8 mb-4">
	    		<li>Licensing and supporting my own products</li>
	    		<li>Supporting projects I have built for clients</li>
	    	</ul> 
	
	    	I work with energy companies, non-profits, educational organizations, and state legislative professionals. I do dev work as well as sales demos, videos, and trainings.
	    	<br><br>
	    	This year, the number of clients I work with went from 6 to 4. This was a mixed blessing -- fewer clients means less context-switching, but also less income (and i like income). Fortunately, the other client projects and the growth of my own SaaS mostly made up the gap.
	    	<br><br>
	    	Ultimately, the ending of the two client projects opened up the time I used to explore hypermedia.
	    	<br><br>
	    	A similar thing happened in 2014 when I was laid off from my full-time job -- and spent the next 3 months learning Laravel, which kick-started the creation of my own company.
	    	<br><br>
	    	
	    	

	    </p>
	    <div class="text-3xl font-bold text-black mt-8">
	    	Personal SaaS
	    </div>
	    <p class="py-3 mt-4">

	    	This was a big year for <a target="_blank" href="https://communityfluency.com">Community Fluency</a>, our constituent service platform for elected officials in Massachusetts. My business partner and I worked together to keep our current clients happy and found a few new types of clients.
	    	<br><br>
	    	To keep this brief (yes, I know you probably don't care about the specifics of this business, but this is MY recap!), here are the highlights:
	    	<ul class="list-decimal pl-8 mb-4">
	    		<li>Grew our revenue about <b>30%</b></li>
	    		<li>Tried to land "The Golden Goose" -- a large government contract. We didn't succeed this time but we learned a lot about the process and realized we were at the top of the pile in terms of everything but connections.</li>
	    		<li>Expanded from elected officials to state agencies</li>
	    	</ul> 

	    	We are not at two full-time salaries yet, but we made significant progress this year and opened up some new possibilities.
	    	
		</p>

		<div class="text-3xl font-bold text-black mt-8">
	    	Real Life
	    </div>
	    <p class="py-3 mt-4">
	    	I won't say much, except that I am a very lucky man. I have a great supportive spouse and two amazing kids.
	    	<br><br>
	    	Along with all the other content creation, I started a personal podcast with a few friends. This has served as a really positive way to connect with them and have some fun with the things in our lives.
	    	<br><br>
	    	The big story of the year is that I focused more on my health, and it has been one of my best decisions of the year. I took a walk almost every day, I started going to the gym, and more recently I start kickboxing classes.
	    	<br><br>
	    	If you are sitting all day, I highly recommend any of those -- walks are the cheapest but probably not the least effective.
	    </p>

		<div class="text-3xl font-bold text-black mt-8">
	    	Recap
	    </div>
	    <p class="py-3 mt-4">
	    	Overall, 2024 was all about solidifying and simplifying my development base while exploring content creation.
	    	<br><br>
	    	Htmx helped with both -- I built a lot of amazing new features into my products using htmx, and I had a ton of fun and growth creating hypermedia content.
	    	

	    </p>

		<div class="text-3xl font-bold text-black mt-8">
	    	Looking Ahead: 2025 Goals
	    </div>
	    <p class="py-3 mt-4">


		    <b>Client Work</b>
		    <br>My goal is to keep my client work steady and growing (without taking new projects, just expanding my work with existing ones) for 2025.
		    <br><br>

		    <b>Personal SaaS</b>
		    <br>I would like to continue growing, and make another try for something big -- either hiring a dedicated sales person or applying for another large government contract. 
		    <br><br>

		    <b>Hypermedia Content</b>
		    <br>I want to grow the youtube channel, and keep posting regularly to the podcast. Each fill a different role -- I can use the podcast for random thoughts, and the youtube for more polished ideas and interviews.
		    <br><br>

		    <b>Paid Courses/Books/Screencasts</b>
		    <br>This is a new idea, but I think a natural extension of where I have been going. The main problem in 2024 is that I spent 25% of my time on hypermedia content, but got 0% (or less!) of my revenue from it. That's fine for now, but not long term sustainable, especially if I want to <b>expand</b> what I do with hypermedia because I find it so enjoyable and rewarding. 
		    <br><br>
		    Offering people something of value (courses, screencasts, ui kits??) and charging for it sounds like a win-win.
		    <br><br>

		    <b>Secret Project</b>
		    <br>I have been working on a secret project (it has to do with mobile apps) that I plan to launch in 2025. I love a secret project, I really do. My plan is to build it, use it for myself first. Then if it's as good as I hope, I will release and launch it as a product. 
		    <br><br>

		    <b>Real Life</b>
		    <br>Live genuinely. Push exercising and movement and traveling. Learn how to do a cartwheel.
		    <br><br>
		    
		    <hr class="my-8">

		    If you read all this, <b>thank you</b> for reading this. My professional life is a weird mix of projects and goals, but maybe there is something in it that resonated with you and your journey. I have never recapped a year before but I hope to make this type of public reflection a regular part of my professional life. <br><br> 
		    Programming rules and I am very fortunate to be able to make my living from it. I hope you get to do the same in whatever way you want to.
		</p>
		
	    <p class="py-3 text-xs text-gray-400 mt-12">

	        Intro
			Securing existing business

			The Year of Htmx
			Hx-pod
			YouTube channel
			Conference
			Comedy
			Added to my inspirations: Aliribe, Carson, Caleb Porzio, Otwell

			Client work
			Licensing software
			Supporting sites
			TLS AH GPG TM
			Two large projects ended

			Personal SaaS
			Built my own constituent service platform for elected officials
			One employee
			Grew revenue, expanded the market

			Life
			Joined kickboxing
			Luckiest man alive
			Personal podcast w/ friends

			Recap
			Overall client projects fewer, revenue for each up
			Personal businesses up
			Opened door for time for content creation

			Looking Ahead: 2025 Goals
			Mobile development
			Course
			Audiobook
			Add revenue from courses
			Makes this more viable
	    
	</div>
</div>

@endsection
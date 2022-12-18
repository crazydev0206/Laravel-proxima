-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 09:18 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meganmeg_proximaride`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `pass`, `type`) VALUES
(2, 'roman', 'ccaned@gmail.com', 'RomanPW!1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `admin_verification`
--

CREATE TABLE `admin_verification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_verification`
--

INSERT INTO `admin_verification` (`id`, `email`, `code`) VALUES
(2, 'ccaned@gmail.com', '6380d00c37989'),
(3, 'ccaned@gmail.com', '6380d149e9913');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `agency` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_on` datetime NOT NULL,
  `writer_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `agency`, `title`, `description`, `image`, `url`, `added_by`, `added_on`, `writer_image`) VALUES
(1, 'CNN', 'Why it’s so hard to give up ridesharing', '<p><strong>By Emanuella Grinberg, CNN&nbsp;</strong><br><strong>Updated 9:49 PM EDT, Fri April 5, 2019</strong></p><p>&nbsp;</p><p>It’s easy to take for granted just how much on-demand services have changed our lives, starting with ride-hailing companies such as Uber and Lyft.&nbsp;<br><br>But every now and then, a jarring headline makes us wonder how it became so normal so quickly to jump into a stranger’s car.&nbsp;<br><br>The share of Americans who have used ride-sharing services more than doubled in the past three years. According to a Pew Research Center survey conducted in 2018, 36% of adults say they have used a ride-hailing service such as Uber or Lyft, compared to 15% in late 2015.&nbsp;<br><br>“There’s clearly something about having the technology there as the mediator that created this level of trust between riders and drivers,” said Saba Waheed, research director at the UCLA Labor Center, whose expertise includes labor and sharing economy businesses like Uber and Lyft.&nbsp;<br><br>But that trust came with a price, she says.&nbsp;<br><br>The increase in ride-hailing services has coincided with reports of violent crimes by drivers against passengers and revelations of concerning business practices.&nbsp;<br><br>In response, companies including Uber and Lyft have pledged to prioritize safety and work with government partners to improve conditions for drivers and riders.&nbsp;<br><br>Meanwhile, research suggests bad publicity and safety concerns have done little to deter riders from using the platforms. Why is that?</p><p>&nbsp;</p><h3>Why we stay</h3><p>Uber and Lyft were part of a class of startups that heralded the now-ubiquitous on-demand economy that lets us order food, toiletries and other modern conveniences from our smartphones.</p><figure class=\"image\"><img src=\"https://media.cnn.com/api/v1/images/stellar/prod/190318093328-lyft-ipo-file.jpg?q=x_0,y_0,h_1687,w_2997,c_fill/h_144,w_256\" alt=\"FILE - In this  Jan. 31, 2018, file photo, a Lyft logo is installed on a Lyft driver\'s car in Pittsburgh. Lyft says it\'s readying for an initial public offering of its shares. The ride sharing service announced Thursday, Dec. 6, that it confidentially submitted a draft registration statement for the proposed IPO. (AP Photo/Gene J. Puskar, File)\"><figcaption>Ridesharing article from CNN</figcaption></figure><p>On-demand companies rewired our lives. Now they must survive Wall Street&nbsp;<br><br>The companies rose to prominence during what transportation experts consider a period of “unprecedented” change in travel behavior. A shifting economy collided with new transportation modes, including shared cars and bicycles, making Americans reconsider transportation options, said Farzad Alemi, a postdoctoral researcher at the Institute of Transportation Studies at UC Davis.&nbsp;<br><br>Alemi used data from a survey of 2,400 California residents, including millennials and members of the preceding Generation X, to investigate factors that affect ride-hailing. His research found the highest adoption rates among millennials with college degrees who lived alone in urban areas, motivated by ease and convenience.&nbsp;<br><br>They didn’t necessarily give up their cars, he said, but they used them less or in combination with other transportation modes. For those who lived in urban areas, ride-hailing was cheaper than owning a car, especially when parking factored into their expenses, he said.&nbsp;<br><br>The 2018 Pew survey reached similar conclusions, with those who are young, affluent and college-educated making up the greatest share of users. And although the share of Americans who use ride-hailing apps has grown dramatically, few adults use them regularly, according to the Pew survey.&nbsp;<br><br>About 4% of adults said they use the apps on a weekly basis, including 2% who say they use them every day or almost every day. That’s about the same as it was in 2015, when 3% of Americans reported being weekly riders.&nbsp;<br><br>In 2018, most adults said they use ride-hailing services less than once a month.&nbsp;<br><br>In 2015, Pew asked people about their views of ride-hailing services. Among their responses:&nbsp;<br><br>86% said they saved users stress and time&nbsp;<br><br>68% said they were less expensive than a taxi&nbsp;<br><br>60% said they were more reliable than a taxi or public transit&nbsp;<br><br>Ride-hailing is not only for the young. An analysis of data from the 2017 National Household Travel Survey found that highly educated, affluent seniors in urban areas were among those who were more likely to be adopters of ride-hailing services.&nbsp;<br><br>Often, these adults must give up their licenses, especially if they have a medical condition, said Suman Kumar Mitra, an assistant project scientist at the Institute of Transportation Studies at UC Irvine.&nbsp;<br><br>Stressed out and at risk: Inside Uber\'s special investigations unit&nbsp;<br><br>Ride-hailing offers them alternatives to both public transportation and the need to rely on others for rides, he said. Often, they use these services to close what experts call the first- and last-mile problem of getting to and from a bus stop or train station.&nbsp;<br><br>Safety is a concern for this population, too, he said. But he surmises that the benefits of the services outweigh the safety concerns.&nbsp;<br><br>“It gives them the freedom to go anywhere any place at any time,” he said.</p><p>&nbsp;</p><h3>How to improve the relationship</h3><p>Other experts agree that for many users, the utility of ride-hailing outweighs any moral or ethical compunctions they elicit.</p><p>&nbsp;</p><p>Ride-hailing companies benefited from a lack of oversight and regulation that allowed them to grow quickly, Waheed said. Now, cities and states are playing catch up to close some of the loopholes that gave the platforms a competitive edge over traditional taxi businesses.</p><p>&nbsp;</p><p>State lawmakers push for ride-share safety bill after USC student\'s death</p><p>&nbsp;</p><p>To improve safety, the platforms say they are working to improve background checks and make signage visible, so people don’t get into the wrong cars.</p><p>&nbsp;</p><p>The platforms share the responsibility with regulators of policing themselves, said Arun Sundararajan, a professor of business at New York University’s Stern School of Business. But consumers also have a role to play as the sharing economy proliferates, he said.</p><p>&nbsp;</p><p>It’s important for consumers to remember they’re not buying a product directly from a brand – they’re buying a product from someone else wrapped in a sort of “micro-franchising” from the brand, he said. As such, there’s a learning curve to becoming a tech-savvy consumer, he said, offering the following tips:</p><p>&nbsp;</p><p>Check not only the rating but driver reviews</p><p>&nbsp;</p><p>Make sure the license plate numbers match up</p><p>&nbsp;</p><p>Make a phone call from inside the car to signal to the driver that someone knows where you are</p><p>&nbsp;</p><p>“My mom used to tell me don’t get into strangers’ car and we’re at a point where we have a layer of digital trust wrapped around that activity,” he said.</p><p>&nbsp;</p><p>“We still have to take some basic steps.”</p>', '1585.png', 'why-its-so-hard-to-give-up-ridesharing', 'Admin', '2022-04-24 11:25:59', ''),
(2, 'CNN', 'The ride hailing industry is getting turned on its head by coronavirus', '<p><strong>By Sara Ashley O\'Brien, CNN Business&nbsp;</strong><br><strong>Updated 6:13 PM ET, Fri March 27, 2020</strong><br>&nbsp;</p><p>Just days after President Donald Trump announced earlier this month that all travel from Europe to the United States would be temporarily suspended due the coronavirus pandemic, a Dallas-based rideshare startup called Alto started seeing a steep drop in demand for rides.&nbsp;<br><br>Will Coleman, Alto\'s founder and CEO, said business was suddenly hurting, and badly, as \"people were starting to heed the warnings here in Dallas.\" Ride volume had fallen by about 75% within a matter of days.&nbsp;<br>The one-and-half year old company didn\'t waste much time before reacting. Last week, it pivoted its focus to delivering food and goods to peoples\' homes, while still servicing the occasional ride. The startup overhauled its website, notified drivers, and began striking up partnerships with local businesses to help service delivery needs ranging from garden supplies to groceries.&nbsp;<br>Alto\'s rideshare drivers aren\'t the only ones who have found themselves becoming accidental delivery workers. As the coronavirus pandemic has forced people to travel less and slashed requests for rides, it has also boosted demand for home deliveries of groceries, meals and other goods. The abrupt shift in consumer behavior caused by the pandemic is upending the on-demand industry, where the biggest companies were built first and foremost around ride-hailing services rather than food deliveries.&nbsp;<br>The City of New York said it would hire licensed TLC drivers to deliver food to New Yorkers in need.&nbsp;<br>Uber and Lyft still aren\'t helping their most vulnerable drivers&nbsp;<br>Uber and Lyft still aren\'t helping their most vulnerable drivers&nbsp;<br>Meanwhile, Lyft, (LYFT) which has not historically offered delivery services, announced last week that it is piloting meal delivery services in the Bay Area in partnership with government agencies and local nonprofits to help those in need. It said it will work to expand the services throughout the country. But Thursday, Lyft sent an email to drivers suggesting they could find work at Amazon as one way of earning additional income, according to a copy of the email provided by Lyft. Last week, Amazon announced plans to hire 100,000 new distribution workers as people increasingly turn to the e-commerce giant to purchase household items during the pandemic.&nbsp;<br>Uber (UBER), which is behind meal delivery service Uber Eats, said it has been encouraging drivers to toggle between its Driver and Delivery services via in-app notifications with instructions. The company said that in the US and Canada, the number of people signing up to deliver meals doubled last week from the week prior.&nbsp;<br>For Alto, the shift meant the startup had to essentially \"start from scratch again,\" said Coleman. But the silver lining was that many of the selling points of its rideshare business, which employs its drivers and is focused on safety and cleanliness, were transferable to delivery during this unprecedented health crisis.&nbsp;<br>Moving to food delivery may help some companies weather the crisis, but it could come at a cost. Daniel Ives, an analyst with Wedbush, notes that Uber\'s meal delivery business has been a \"money-losing\" venture that has weighed on the stock. Ives said the margins on delivery are lower than ride-hailing, as is how much the company takes on an order. \"Ride sharing remains the bread and butter for Uber and Lyft with some dark days ahead as lockdowns remain around the world,\" he said.&nbsp;<br>Instacart plans to hire 300,000 more workers as demand surges for grocery deliveries&nbsp;<br>Instacart plans to hire 300,000 more workers as demand surges for grocery deliveries&nbsp;<br>In a blog post this week, Pierre-Dimitri Gore-Coty, head of Uber\'s food delivery platform Eats, wrote that \"while it\'s too early to say what impact the coronavirus crisis will have on food delivery overall, we\'re seeing signals that people are relying on delivery services more.\"&nbsp;<br>\"Cities like Seattle and San Francisco have seen an uptick in food delivery requests on Uber Eats recently,\" he added. (Both locations are under stay-at-home orders.)&nbsp;<br>For some companies, the trend has led to rapid expansion. Instacart, the grocery delivery startup, said this week that it plans to bring on 300,000 additional workers in North America over the next three months to help meet its surging demand.&nbsp;<br>Erica Mighetto, a rideshare driver for Uber and Lyft, is one of the many now considering picking up orders for Instacart. She said demand for rides has plummeted so much that continuing to drive for the platforms has not even been worth the price of gas for her car recently. She also has a heart condition and wants to stay home to protect her health, but she has a car loan payment due.&nbsp;<br>\"My plan for the next few days is to try Uber Eats,\" she said, adding that she applied to work for Instacart last week but has yet to start taking orders. She\'s still nervous about \"setting foot in a grocery store where there\'s more people.\"</p><p>&nbsp;</p>', '8781.png', 'the-ride-hailing-industry-is-getting-turned-on-its-head-by-coronavirus', 'Admin', '2022-04-24 11:51:04', ''),
(3, 'CBC', 'Ride-sharing was supposed to make traffic better', '<p><strong>CBC Radio&nbsp;</strong></p><p><strong>Posted: Sep 07, 2018 3:42 PM ET. Last Updated: July 5, 2019</strong>&nbsp;<br><br>New York City capped the number of ride-sharing vehicles allowed on the road to stem congestion&nbsp;<br><br>This story was originally published on September 7, 2018.&nbsp;<br><br>Besides making it super-easy to get a ride somewhere, one of the great promises of ride-hailing services like Uber and Lyft was that they would reduce congestion in city streets as more people left their cars at home and shared with others.&nbsp;<br><br>Unfortunately, the opposite has happened — and dramatically so, said transportation consultant Bruce Schaller.&nbsp;<br><br>Schaller, the former head of the traffic and planning division at the New York City Department of Transportation, recently investigated the impact of ride-hailing services on congestion. And the results are not encouraging.&nbsp;<br><br>It turns out that the majority of ride-share app users are not people who would otherwise drive their car, but people who wouldn\'t have driven a car in the first place.&nbsp;<br><br>\"Most people say, \'I would have taken the bus, the subway, the metro, walked or biked or sometimes, I wouldn\'t have made that trip,\'\" Schaller said.&nbsp;<br><br>Moreover, the fact that the ride-hailing cars have to come and get their passengers actually means more mileage.&nbsp;<br><br>\"If I call Uber to pick me up, the driver has to come to my house and then drive me there. So there\'s a time between trips and mileage between trips that are additional miles to the roadway.\"&nbsp;<br><br>And it\'s not like the ride-sharing cars get off the roads when they\'re aren\'t driving someone.&nbsp;<br><br>\"Last year, 40 per cent of the time Uber and Lyft vehicles don\'t have a passenger in them. That\'s really inefficient,\" Schaller said.</p>', '6361.webp', 'ride-sharing-was-supposed-to-make-traffic-better', 'Admin', '2022-04-24 12:07:13', ''),
(4, 'CNBC', 'Ride-sharing stocks a rare bright spot in otherwise miserable day for tech', '<p>Jessica Bursztynsky @JBURSZ</p><p>PUBLISHED WED, MAR 3 20211:05 PM ESTUPDATED WED, MAR 3 20214:07 PM EST&nbsp;</p><p>&nbsp;</p><p>KEY POINTS&nbsp;</p><ul><li>Ride-sharing stocks closed Wednesday as a rare bright spot for tech stocks in an otherwise weak day.&nbsp;</li><li>Shares of Lyft closed up more than 8% as investors rallied around the company after it said it’s seeing rideshare recovery sooner than expected.&nbsp;</li><li>Lyft’s recovery also brought optimism to Uber shares, which closed up 2.6%.&nbsp;</li></ul><p>&nbsp;</p><p>Ride-sharing stocks closed Wednesday as a rare bright spot for tech stocks in an otherwise weak day for the sector that’s seen strong growth in the past year.&nbsp;<br><br>Shares of Lyft closed up more than 8% as investors rallied around the company after it said it’s seeing rideshare recovery sooner than expected.&nbsp;<br><br>Lyft’s recovery also brought optimism to Uber shares, which closed up 2.6%. It comes despite CEO Dara Khosrowshahi’s cautious comments Monday at the Morgan Stanley Tech conference, saying he expects its mobility business to see some signs of recovery in the U.S. and Europe, though it’s “too early to tell.”&nbsp;<br><br>The tech sector’s drop came as the 10-year Treasury yield extended its gains. The rate climbed to 1.49% Wednesday after hitting a high of 1.6% last week. Yields move inversely to prices. That rise has raised concerns for some about equity valuations and a pickup in inflation, CNBC reported. Higher bond yields can hit technology stocks particularly hard as they have been relying on easy borrowing for superior growth.&nbsp;<br><br>Investors rotated out of the pandemic’s cloud darlings, as Twilio closed down 7.6% and Atlassian down 6.8%. Snowflake, which also was set to report earnings after the bell, closed down 8.7%. The largest tech stocks weren’t spared either. Tesla shed 4.8%, while Amazon closed down nearly 3%. Apple and Microsoft each shed 2.5% and 2.7%, respectively. Alphabet closed down 2.6%.&nbsp;<br><br>Lyft comes off strongest week since lockdowns began&nbsp;<br>Lyft now expects to manage its adjusted EBITDA loss in the first quarter to $135 million, from the $145 million to $150 million it previously forecast, according to a Tuesday filing with the SEC. The company also said that the last week of February was its best week in terms of volume since pandemic lockdowns began in March of 2020, and expects recovery to continue into this month.&nbsp;<br><br>The company’s burgeoning recovery comes as more states are starting to lift Covid-19 restrictions and vaccines continue to roll out across the nation.&nbsp;<br><br>“We believe LYFT is poised to show an inflection towards positive year-over-year growth starting the week of March 21, which we think will accelerate into the summer months barring any setbacks with vaccine roll-outs. We see LYFT’s Q1 rides outlook as a positive, especially given the still uncertain landscape of the pandemic and weather issues in certain regions,” according to CFRA analysts on Wednesday.&nbsp;<br><br>Truist analysts said Tuesday that the company’s update on business trends gives the firm “incremental confidence that business trends should continue to improve as local governments ease restrictions on social activities and people return to work with C-19 gradually waning.”&nbsp;<br><br>“We believe further easing of restrictions, particularly in Texas, which has completely reopened, could accelerate improving Y/Y trends through the Spring,” they added.&nbsp;<br><br>Uber and Lyft have still maintained optimism they will become profitable by the end of this year on an adjusted EBITDA basis.&nbsp;<br><br>“At this point LYFT is seeing encouraging demand signs, and has been able to manage this demand while guiding to improved profitability while showing solid execution,” Needham analysts wrote in a note to clients Wednesday.&nbsp;<br><br>--CNBC’s Michael Bloom contributed reporting.</p>', '2642.webp', 'ride-sharing-stocks-a-rare-bright-spot-in-otherwise-miserable-day-for-tech', 'Admin', '2022-04-24 12:11:53', ''),
(5, 'CNBC', 'Why many Uber and Lyft drivers aren’t coming back', '<p><strong>Jessica Bursztynsky @JBURSZ</strong></p><p><strong>PUBLISHED SUN, JUL 4 20211:25 PM EDT</strong></p><p>&nbsp;</p><ul><li>KEY POINTS:<br>After a dramatic decline in traveling this past year, people are ready to get moving again. In many cases, they’re turning to rideshares.&nbsp;</li><li>But companies like Uber and Lyft are still struggling to bring drivers back to full speed, leading to longer wait times for customers and higher prices.&nbsp;</li><li>There’s a handful of factors at play when it comes to getting drivers back and convincing new ones to sign up.</li></ul><p>&nbsp;</p><p>After a dramatic decline in traveling this past year, people are moving again. Yet, despite offering cash incentives, rideshare giants Uber and Lyft are still struggling to bring drivers back to full speed, leading to longer wait times for customers and soaring prices.&nbsp;<br><br>Uber and Lyft have put millions into these efforts, but some former drivers aren’t even looking at these stimulus packages or trying to get in on surge pricing. A large percentage who are still holding out.&nbsp;<br><br>“Drivers are in a low-key strike,” Nicole Moore, a volunteer organizer with Rideshare Drivers United, told CNBC.&nbsp;<br><br>“Right now it’s a mini debacle for Uber and Lyft in terms of driver shortages and surge pricing throughout the US,” Wedbush’s Dan Ives said in an email. “Drivers are ~40% below capacity.”&nbsp;<br><br>Former ride-sharing drivers are staying off the road for a variety of reasons.&nbsp;<br><br>For many it’s fear of the continued pandemic, which is what made them stop driving in the first place. Currently, less than 50% of the U.S. population is fully vaccinated against Covid-19, according to data from the Centers for Disease Control and Prevention.&nbsp;<br><br>“This thing is not over yet, people can still get sick,” Louis Wu, a Texas resident and former rideshare driver, told CNBC. According to Uber, 80% of drivers planned to come back once vaccinated. The company has also heavily invested resources into getting people vaccinated, offering free rides to vaccine spots through early July, as a part of its effort to get people back on the road.&nbsp;<br><br>Others, wanting to stay in the gig economy but fearful of transmission, have switched to food or grocery delivery. That’s also allowed them to put less wear-and-tear on their cars, especially as gas prices and car parts prices increase.&nbsp;<br><br>“In times of Covid, there’s a lot less customer interaction with food delivery vs transporting a passenger in your backseat,” Harry Campbell, who runs The Rideshare Guy blog, said in an email. “You also put less miles on your car as a delivery driver since people order from nearby restaurants vs a full-time ride-hail driver that can easily do 1,000 miles per week or more. A lot of ride-hail drivers just get tired of dealing with people too.”&nbsp;<br><br>Some drivers have also remained on unemployment benefits, which are set to expire later this year. For those former drivers, they may be coaxed back into offering services once extended benefits phase out in the fall.&nbsp;<br><br>“September will be the big tell tale sign if drivers were holding out because of unemployment,” said Chris Gerace, a driver and contributor to Campbell’s blog.&nbsp;<br><br><strong>Better jobs</strong>&nbsp;<br>Uber and Lyft said they thought the supply and demand problems would see recovery in the third quarter, which started July 1. However, if demand continues to outpace supply, it could pressure the rideshare companies to make more fundamental changes to cater to drivers.&nbsp;<br><br>Uber, for example, is considering funding education and career-building programs, according to The Wall Street Journal. Lyft is also exploring ways to reduce drivers’ expenses, according to the report published Friday.&nbsp;<br><br>But many drivers have gotten a taste of what working outside of the gig economy is like. Moore said she knows former drivers who have since gotten office jobs or switched to driving semi trucks, with no intention of coming back.&nbsp;<br><br>Some gig workers have become increasingly frustrated with how the rideshare giants pay out, especially as surge pricing continues.&nbsp;<br><br>The Washington Post reported last month that despite the high rates passengers are paying, drivers aren’t getting their cut. And drivers have continued to call out the companies, saying it’s increasingly difficult to make a living on the apps, especially when compared with the early days of the companies.&nbsp;<br><br>“When I started driving, I was guaranteed 80% of the fare,” Moore said. “If that’s where we were right now, you would see a very different equation on the road. Drivers are seeing 20, 30, 40% of the fare at times.”&nbsp;<br><br>But it’s a question of if rideshare companies will listen and be open to fundamental changes, Gerace said.&nbsp;<br><br>The shortage also comes parallel with Uber’s and Lyft’s promises to reach profitability on an adjusted EBITDA basis by the end of the year, and pressure on the balance sheet could make that goal even harder.&nbsp;<br><br>“If these companies had a paradigm-shifting core belief, you could have good pay for drivers, you could have good competitive rates and you could become profitable and have that win-win-win, but you have to take that initiative and be open to trying new things,” Gerace said.&nbsp;<br><br>Uber declined to comment, pointing to an April blog post on its $250 million stimulus. A Lyft spokesperson pointed toward comments its president, John Zimmer, made in late May, saying the company was “extremely confident” in supply recovery.</p>', '7475.webp', 'why-many-uber-and-lyft-drivers-arent-coming-back', 'Admin', '2022-04-24 12:18:44', ''),
(6, 'Global News', 'Ridesharing firms urge B.C. to temporarily scrap license requirements under COVID-19', '<p>Richard Zussman &nbsp;Global News&nbsp;<br>Posted May 12, 2020 5:23 pm. Updated May 13, 2020 1:25 pm&nbsp;<br>&nbsp;</p><p>The biggest ridesharing companies operating in B.C. are calling on the province to ease the Class 4 licence requirements for drivers in a bid to get more drivers on the road.&nbsp;<br><br>In a letter sent to Transportation Minister Claire Trevena and obtained by Global News, the companies suggest that a Class 5+ licence could provide short-term work for those out of a job due to the novel coronavirus pandemic.&nbsp;<br><br>“COVID-19 has resulted in too many people becoming unemployed, working reduced hours, or just needing an easy and quick way to put food on the table for their families,” reads the letter, signed by Lyft Canada, Whistle!, Uber Canada, Coastal Rides and KABU-Ride Inc.&nbsp;<br><br>“Working together, we can make things better for these people.”&nbsp;<br><br>The Class 4 licence required to work as a ridesharing driver in B.C. has been contentious.&nbsp;<br><br>The all-party MLA committee tasked with setting out regulations for the industry recommended a specific Class 5+ licence catered towards such drivers.&nbsp;<br><br>But Trevena turned it down, opting for the existing commercial Class 4 licence and requiring an additional written and driving test and a physical exam from a doctor.&nbsp;<br><br>ICBC has suspended road tests indefinitely under the pandemic.&nbsp;<br><br>Lyft and Uber, the world’s largest ridesharing companies, have been operating since January in B.C., after receiving long-awaited approval from the independent Passenger Transportation Board.&nbsp;<br><br>The industry argues that an easing of the current licencing requirement can especially help women who have seen greater jobs losses because of the pandemic than men have.&nbsp;<br><br>“Ridesharing can give women impacted by COVID-19 immediate opportunities to make money to support themselves and their loved ones,” the letter reads.&nbsp;<br><br>A Class 5+ licence could allow drivers to earn money ridesharing after they pass a Class 4 knowledge test but not a road test.&nbsp;<br><br>In a statement, the Ministry of Transportation and Infrastructure says government’s next step through the pandemic is a careful restart of the economy while protecting people and all the progress B.C. has made.&nbsp;<br><br>The province is not planning on making any changes to the licencing structure for ridesharing vehicles.&nbsp;<br><br>“Our Class 4 requirement for ride-hail puts passenger safety first. We specifically developed a model that has the highest safety standards in North America,” the statement reads.&nbsp;<br><br>“We’re proud of the work we’ve done and we will not be rolling back any safety measures at this time. People want to know when they get in a ride-hail vehicle that they are with a driver who has a good driving record, has passed a criminal record check and medical exam, and the vehicle has been inspected.”&nbsp;<br><br>The five companies also suggested using the National Safety Code, which regulates commercial drivers, and allow Class 5 licence holders who have other safety requirements to be on the road so as not to put a “burden” on ICBC.&nbsp;<br><br>The letter also suggests increasing the vehicle age requirement to 15 years outside of urban areas to allow more drivers to qualify.&nbsp;<br><br>“We have demonstrated for the past almost four months that we can be relied upon to help connect drivers offering safe and healthy transportation services to essential workers,” the letter reads.&nbsp;<br><br>“The next phase of COVID-19 is equally as critical. Ridesharing can provide flexible earning opportunities for all British Columbians and particularly those impacted by COVID-19 job loss.”&nbsp;<br><br>BC Liberal MLA Jas Johal says the government’s decision to require class 4 licensing was always a political decision, and not one grounded in the needs of B.C. consumers.&nbsp;<br><br>Johal says he has advocated for a class 5+ since the beginning and switching now would provide additional flexibility.&nbsp;<br><br>“The NDP have essentially created a system where there are not enough drivers in major cities or no service in smaller communities,”Johal said.&nbsp;<br><br>“Beyond ridehailing, the NDP have done nothing to modernize the taxi industry or level the playing field for many struggling taxi owners.”&nbsp;</p>', '3414.webp', 'ridesharing-firms-urge-bc-to-temporarily-scrap-license-requirements-under-covid-19', 'Admin', '2022-04-24 12:25:51', ''),
(7, 'Global News', 'Châteauguay residents call for ridesharing service amid long wait times for taxis', '<p><strong>By Brayden Jagger Haines &nbsp;Global News&nbsp;</strong></p><p><strong>Posted January 24, 2020 11:19 am</strong></p><p>&nbsp;</p><p>Long wait times for taxis in Châteauguay have caused residents to call for the ridesharing service Uber to operate in the South Shore city.&nbsp;<br><br><br>Frustrated by the slow taxi service, BLVD Bar and Grill owner Michael Ghorayeb started an online petition to bring the ride-hailing service to Châteauguay.&nbsp;<br><br>More than 1,000 residents have signed the petition, which started on Monday.&nbsp;<br><br>It can take up to two hours some nights for clients from the bar to get a ride home, Ghorayeb said.&nbsp;<br><br>The long delay is bad for business, Ghorayeb said, but it is also concerning, as clients tend to risk driving home instead of waiting for a taxi.&nbsp;<br><br>“When we have 30 to 40 kids leaving the bar who can’t get a ride home then hitting the streets at that time of night, either for them or the city, it is not a good thing,” Ghorayeb said.&nbsp;<br><br>There are only two taxi companies, Prestige and Oxford, that operate in Châteauguay.&nbsp;<br><br>The government has only allowed a total of 50 taxi permits in the area.&nbsp;<br><br>Servicing three cities — Léry, Châteauguay and Mercier — the two companies are spread thin, Prestige taxi owner George El-Assaad said.&nbsp;<br><br>“There is some waiting on Friday and Saturday, but we have lots of calls at night and we have less drivers but we do our best to serve,” El-Assaad said.&nbsp;<br><br>Ghorayeb says that at closing time, there is a rush, and many of his clients are left out in the cold.&nbsp;<br><br>The available taxis from the two companies give priority to the popular nearby Kahnawake casinos.&nbsp;<br><br>“I think Uber will alleviate a lot of the pressure. I think it will help us a lot to have an extra service at those times,” Ghorayeb said.&nbsp;<br><br>Châteauguay is currently outside of the Transportation Ministry’s pilot project area for Uber’s licensing.&nbsp;<br><br>In a statement to Global News, Uber said it always wants to “see more Canadians benefit from ridesharing.”&nbsp;<br><br>“When new regulations come into effect later in the year, we would welcome the opportunity to come to Châteauguay,” the company said.&nbsp;<br><br>New regulations for Uber are expected to come into effect in October, permitting the ridesharing service across the province.&nbsp;<br><br>Quebec Transportation Ministry spokesperson Martin Girard said the ministry will not comment on the petition but noted that Uber can offer its services in Châteauguay beginning in the fall when the new regulations will come into effect.&nbsp;<br><br>In the meantime, El-Assaad said representatives from both taxi companies will be meeting with city officials to discuss how to better provide service during the nightly rush hours.&nbsp;<br><br>El-Assaad said he will be adding more drivers on the weekend night shift.</p>', '2466.webp', 'chteauguay-residents-call-for-ridesharing-service-amid-long-wait-times-for-taxis', 'Admin', '2022-04-24 12:31:33', ''),
(9, 'CNBC', 'test', '<p>test</p>', '8393.jpg', 'test', 'test', '2022-12-31 12:59:00', '6334a94d8abb6_cover.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `driver_id` mediumint(8) UNSIGNED NOT NULL,
  `ride_id` mediumint(8) UNSIGNED NOT NULL,
  `ride_date` date NOT NULL,
  `ride_time` time NOT NULL,
  `seats` mediumint(8) UNSIGNED NOT NULL,
  `ride_price` float UNSIGNED NOT NULL,
  `booking_price` float UNSIGNED NOT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booked_on` datetime NOT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `charge_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `free_ride` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `refund_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_charge_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_email` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_id` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` float UNSIGNED NOT NULL,
  `booking_credit` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `reminder` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `driver_id`, `ride_id`, `ride_date`, `ride_time`, `seats`, `ride_price`, `booking_price`, `payment_method`, `booked_on`, `status`, `charge_id`, `customer_id`, `free_ride`, `refund_id`, `booking_charge_id`, `token`, `paypal_email`, `payer_id`, `s_id`, `code`, `time_limit`, `booking_credit`, `reminder`) VALUES
(22, 88, 87, 203, '2022-11-16', '07:00:00', 1, 70, 5, 'Cash', '2022-11-15 12:43:58', '4', '', '', '0', '', '', '', '', '', '', '', 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_seats`
--

CREATE TABLE `cancelled_seats` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `booking_id` mediumint(8) UNSIGNED NOT NULL,
  `driver_id` mediumint(8) UNSIGNED NOT NULL,
  `ride_id` mediumint(8) UNSIGNED NOT NULL,
  `seats` mediumint(8) UNSIGNED NOT NULL,
  `refund_amount` float UNSIGNED NOT NULL,
  `on_date` datetime NOT NULL,
  `refund_id` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `customer_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_month` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_year` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last4` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `customer_id`, `card_id`, `brand`, `exp_month`, `exp_year`, `last4`, `added_on`) VALUES
(1, 14, 'cus_HPmx4pmol93Jib', 'card_1GqxNjCIqY287D8EGafJrGgP', 'Visa', '2', '2022', '4242', '2020-06-06 03:28:02'),
(2, 20, 'cus_I6lA4vUK8c81YC', 'card_1HWXeACIqY287D8EJRCfJt0S', 'Visa', '12', '2022', '4242', '2020-09-28 20:28:53'),
(3, 79, 'cus_MinRhIX0UaYbpR', 'card_1LzLqNDNGB70v7fGr2csB5UL', 'Visa', '4', '2023', '4242', '2022-11-01 09:53:36'),
(4, 81, 'cus_MioxHYL1MxspHG', 'card_1LzNJNDNGB70v7fGxqtIeTl7', 'Visa', '4', '2024', '4242', '2022-11-01 11:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `credits_package`
--

CREATE TABLE `credits_package` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `credits_buy` mediumint(8) UNSIGNED NOT NULL,
  `credits_get` mediumint(8) UNSIGNED NOT NULL,
  `credits_price` float UNSIGNED NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credits_package`
--

INSERT INTO `credits_package` (`id`, `credits_buy`, `credits_get`, `credits_price`, `added_on`) VALUES
(1, 1, 1, 5, '2020-06-11 16:51:06'),
(2, 10, 15, 50, '2020-06-11 16:51:19'),
(3, 20, 30, 100, '2020-06-11 16:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `ride_id` mediumint(8) UNSIGNED NOT NULL,
  `booking_id` mediumint(8) UNSIGNED NOT NULL,
  `rating` float NOT NULL,
  `review` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_on` datetime NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `driver_id` mediumint(8) UNSIGNED NOT NULL,
  `timeliness` float UNSIGNED NOT NULL,
  `vehicle_condition` float UNSIGNED NOT NULL,
  `safety` float UNSIGNED NOT NULL,
  `conscious` float UNSIGNED NOT NULL,
  `comfort` float UNSIGNED NOT NULL,
  `communication` float UNSIGNED NOT NULL,
  `posted_by` mediumint(8) UNSIGNED NOT NULL,
  `attitude` float UNSIGNED NOT NULL,
  `respect` float UNSIGNED NOT NULL,
  `hygiene` float UNSIGNED NOT NULL,
  `feature` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `recommend` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `ride_id`, `booking_id`, `rating`, `review`, `added_on`, `type`, `driver_id`, `timeliness`, `vehicle_condition`, `safety`, `conscious`, `comfort`, `communication`, `posted_by`, `attitude`, `respect`, `hygiene`, `feature`, `recommend`, `note`) VALUES
(1, 14, 74, 1, 0, 'Great and pleasant passenger', '2020-06-08 04:40:14', '2', 13, 5, 0, 5, 0, 0, 5, 14, 5, 5, 5, '0', '', ''),
(2, 14, 74, 1, 0, 'Very good driver; safe and friendly', '2020-06-08 04:44:12', '1', 13, 5, 5, 5, 5, 5, 5, 14, 0, 0, 0, '0', '', ''),
(3, 14, 109, 2, 0, 'Great person, pleasure to travel with', '2020-06-13 17:32:11', '2', 13, 5, 0, 5, 0, 0, 5, 14, 5, 5, 5, '1', '', ''),
(4, 14, 109, 2, 0, 'Great and safe driver. Nice and comfortable car', '2020-06-13 17:35:37', '1', 13, 5, 5, 5, 5, 5, 5, 14, 0, 0, 0, '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`id`, `user_id`, `code`) VALUES
(1, 18, '759052ee6cc356bbc936'),
(3, 13, 'bef76e8b8d4ed94b0743'),
(4, 10, '1c90c390691bde037b71'),
(5, 10, 'ac31aa72466a3beeeffb'),
(6, 115, '639298b22ac16'),
(7, 115, '639298be35cec'),
(8, 115, '639299f2d7785'),
(9, 115, '63929a3fdc751'),
(10, 115, '63929a5ccf9e5'),
(11, 115, '63929a841dbe1'),
(12, 115, '63929aae3cf1e'),
(13, 115, '63929bf9d4d40'),
(14, 115, '63929c0e7e8f6'),
(15, 115, '63929caedf948'),
(16, 115, '63929cc348044'),
(17, 115, '63929cd7cc5cc'),
(18, 115, '63929cec8acea'),
(19, 115, '63929d0169e6d'),
(20, 115, '63929d2904a5e'),
(25, 1, '6395dae29bb2c'),
(26, 1, '6395e44a03603'),
(27, 1, '6395e75e6d05f'),
(28, 1, '6395e7653587d'),
(29, 1, '63960e2a07f2e'),
(30, 1, '63960e8c5bd48');

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `departure` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_lat` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_lng` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_lat` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_lng` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_distance` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_time` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `recurring` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `seats` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_no` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smoke` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `animal_friendly` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `features` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_back_seats` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luggage` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept_more_luggage` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `open_customized` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float UNSIGNED NOT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` mediumint(8) UNSIGNED NOT NULL,
  `added_on` datetime NOT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_place` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_route` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_zipcode` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_city` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_state` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_country` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_place` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_route` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_zipcode` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_city` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_state` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_country` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `skip_vehicle` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `until_date` date NOT NULL,
  `until_limit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repeated` mediumint(8) UNSIGNED NOT NULL,
  `last_repeated` date NOT NULL,
  `parent` mediumint(8) UNSIGNED NOT NULL,
  `pickup` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dropoff` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departure_state_short` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_state_short` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `closed` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `suspend` int(11) NOT NULL DEFAULT 0,
  `middle_seats` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_seats` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`id`, `departure`, `departure_lat`, `departure_lng`, `destination`, `destination_lat`, `destination_lng`, `total_distance`, `total_time`, `date`, `time`, `recurring`, `details`, `seats`, `model`, `vehicle_type`, `other`, `year`, `color`, `license_no`, `car_type`, `smoke`, `animal_friendly`, `features`, `booking_method`, `max_back_seats`, `luggage`, `accept_more_luggage`, `open_customized`, `price`, `payment_method`, `notes`, `added_by`, `added_on`, `url`, `departure_place`, `departure_route`, `departure_zipcode`, `departure_city`, `departure_state`, `departure_country`, `destination_place`, `destination_route`, `destination_zipcode`, `destination_city`, `destination_state`, `destination_country`, `car_image`, `skip_vehicle`, `status`, `until_date`, `until_limit`, `repeated`, `last_repeated`, `parent`, `pickup`, `dropoff`, `departure_state_short`, `destination_state_short`, `closed`, `suspend`, `middle_seats`, `back_seats`) VALUES
(200, 'Lahore, Pakistan', '31.5203696', '74.35874729999999', 'Islamabad, Pakistan', '33.6844202', '73.04788479999999', '378 km', '4 hours 26 mins', '2022-11-04', '07:00:00', '', 'test', '7', 'Toyota', 'Convertible', '', '2004', 'Red', '45587', '', 'Yes', 'Yes', 'Wi-Fi;I take infants and I provide car baby seat(s);I take infants if the passenger provides car baby seat(s)', 'Manual approval', '', 'L', '1', '1', 17, 'Online payment', 'test', 84, '2022-11-03 10:25:53', 'lahore-to-islamabad-1', '', '', '', 'Lahore', 'Punjab', 'Pakistan', '', '', '', 'Islamabad', 'Islamabad Capital Territory', 'Pakistan', '8832.png', '0', '2', '0000-00-00', '', 0, '0000-00-00', 0, 'Yaadgar', 'Pakistan', 'Punjab', 'Islamabad Capital Territory', '0', 0, '2', '2'),
(201, 'Lahore, Pakistan', '31.5203696', '74.35874729999999', 'Islamabad, Pakistan', '33.6844202', '73.04788479999999', '378 km', '4 hours 26 mins', '2022-11-04', '07:00:00', '', 'test', '7', 'Toyota', 'Convertible', '', '2004', 'Red', '45587', '', 'Yes', 'Yes', 'Wi-Fi;I take infants and I provide car baby seat(s);I take infants if the passenger provides car baby seat(s)', 'Manual approval', '', 'L', '1', '1', 17, 'Online payment', 'test', 84, '2022-11-03 10:25:53', 'lahore-to-islamabad-201', '', '', '', 'Lahore', 'Punjab', 'Pakistan', '', '', '', 'Islamabad', 'Islamabad Capital Territory', 'Pakistan', '8832.png', '0', '2', '0000-00-00', '', 0, '0000-00-00', 0, 'Yaadgar', 'Pakistan', 'Punjab', 'Islamabad Capital Territory', '0', 0, '2', '2'),
(202, 'Lahore, Pakistan', '31.5203696', '74.35874729999999', 'Islamabad, Pakistan', '33.6844202', '73.04788479999999', '378 km', '4 hours 26 mins', '2022-11-24', '04:27:00', '', 'test', '7', 'Toyota', 'Convertible', '', '2004', 'Red', '45587', '', 'Yes', 'Yes', 'Wi-Fi;I take infants and I provide car baby seat(s);I take infants if the passenger provides car baby seat(s)', 'Manual approval', '', 'L', '1', '1', 17, 'Online payment', 'test', 84, '2022-11-04 03:57:59', 'lahore-to-islamabad-201', '', '', '', 'Lahore', 'Punjab', 'Pakistan', '', '', '', 'Islamabad', 'Islamabad Capital Territory', 'Pakistan', '8832.png', '0', '2', '0000-00-00', '', 0, '0000-00-00', 0, 'Yaadgar', 'Pakistan', 'Punjab', 'Islamabad Capital Territory', '0', 0, '2', '2'),
(203, 'Montreal, QC, Canada', '45.5018869', '-73.56739189999999', 'Toronto, ON, Canada', '43.653226', '-79.3831843', '542 km', '6 hours 11 mins', '2022-11-16', '07:00:00', '', 'Pick-up point: McDonald\'s parking lot at the Cote-Verut metro station \r\nDrop-off: I can also drop you off at Scarborough Town center if you want', '6', 'Dodge Grand caravan', 'Minivan', '', '2016', 'Black', 'AAA111', '', 'No', 'No', 'I take infants if the passenger provides car baby seat(s);I take children if the passenger providers car baby seat(s);Winter tires;Air conditioning;Heating', 'Instant booking', '', 'M', '1', '1', 70, 'Cash', 'No waiting time. Other passengers have work to attend', 87, '2022-11-15 12:24:13', 'montreal-to-toronto-203', '', '', '', 'Montreal', 'Quebec', 'Canada', '', '', '', 'Toronto', 'Ontario', 'Canada', '9695.jpg', '0', '1', '0000-00-00', '', 0, '0000-00-00', 0, 'Cote-Vertu metro station', 'Don Mills metro station', 'QC', 'ON', '0', 0, '2', '3');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `site_name` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_price` float UNSIGNED NOT NULL,
  `booking_per` float UNSIGNED NOT NULL,
  `gas_cost` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `site_name`, `keywords`, `description`, `facebook`, `instagram`, `youtube`, `twitter`, `booking_price`, `booking_per`, `gas_cost`) VALUES
(1, 'ProximaRide', 'Rideshare Montreal to Toronto, rideshare Montreal to Quebec City, rides to Brampton, rideshare Ottawa to Montreal, rideshare Montreal to Ottawa, covoiturage Quebec, covoiturage Montreal, covoiturage Canada, rideshare Canada, rideshare Montreal, rideshare Ontario', 'Safe & affordable rideshare & carpooling in Canada, ProximaRide', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.youtube.com', 'https://www.twitter.com', 5, 1, 0.15);

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `response` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `response`) VALUES
(1, 'SID: SM708bc1a67a7d3fd268f3edb18594a5d1, From: +12564963971, Body: what, Status: '),
(2, 'SID: SMded144ce6a4b52caa0d79a96f6e9259f, From: +16823316290, Body: stuuuuupid, Status: ');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `to_id` mediumint(8) UNSIGNED NOT NULL,
  `link_id` mediumint(8) UNSIGNED NOT NULL,
  `type` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `on_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `to_id`, `link_id`, `type`, `price`, `on_date`) VALUES
(37, 84, 0, 0, '8', 50, '2022-11-03 10:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `facebook_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `smoke` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `emails` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `driver_license` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_card` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `google` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `balance` float UNSIGNED NOT NULL,
  `booking_price` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_per` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_booking` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `referral` mediumint(8) UNSIGNED DEFAULT NULL,
  `free_rides` mediumint(8) UNSIGNED NOT NULL,
  `pets` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `welcome` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `home_country` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_address` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_city` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_state` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_zipcode` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `student` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `features` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_email` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(900) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_verified` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email_verified` int(11) NOT NULL DEFAULT 0,
  `country_code_new` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_code` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_new` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `step` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `linkedin_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `suspend` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `booking_credits` mediumint(8) UNSIGNED NOT NULL,
  `referral_bookings` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `lang` char(6) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `board_status` tinyint(4) DEFAULT NULL,
  `id_card_image` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card_number` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `type`, `account_type`, `gender`, `country`, `state`, `city`, `email`, `pass`, `verify`, `created_on`, `facebook_id`, `avatar`, `google_id`, `profile_image`, `phone`, `about`, `smoke`, `sms`, `emails`, `status`, `driver_license`, `school_name`, `student_card`, `address`, `lat`, `lng`, `facebook`, `google`, `instagram`, `youtube`, `dob`, `balance`, `booking_price`, `booking_per`, `charge_booking`, `referral`, `free_rides`, `pets`, `welcome`, `home_country`, `home_address`, `home_city`, `home_state`, `home_zipcode`, `contact_email`, `contact_phone`, `driver`, `student`, `features`, `update_email`, `code`, `token`, `zipcode`, `country_code`, `otp`, `phone_verified`, `email_verified`, `country_code_new`, `sms_code`, `phone_new`, `deleted`, `step`, `linkedin_id`, `suspend`, `booking_credits`, `referral_bookings`, `lang`, `board_status`, `id_card_image`, `id_card_number`) VALUES
(1, 'idris-lawal', 'Idris', 'Lawal', '2', 'driver', 'Male', 'Nigeria', NULL, NULL, 'blawidris@gmail.com', '$2y$10$frSQhcHU6NxjVgwSycq/Neipr57o5SBVz/P2a8R4PqzEUn3mIZLY.', '', '2022-12-10 15:57:48', '', '', '', '8879.jpg', '(806) 787-6208', '', 'No', '1', '1', '0', '5176.png', '', '', '', '', '', '', '', '', '', '1997-02-18', 0, NULL, NULL, '1', NULL, 0, 'Yes', '0', '', '', '', '', '', '', '', '2', '0', 'Electric car;I want only 5 star passengers;Bike rack;Air conditioning', '', '', '', '', '234', '', '1', 1, '', NULL, '', '0', '6', '', '0', 0, '0', 'en', NULL, NULL, NULL),
(2, 'james-adele', 'James', 'Adele', '1', NULL, NULL, NULL, NULL, NULL, 'novelist900@gmail.com', '_aYoola@23!', '', '2022-12-11 11:34:26', '', '', '', '', '', '', '', '1', '1', '0', '', '', '', '', '', '', '', '', '', '', NULL, 0, NULL, NULL, '1', NULL, 0, '', '0', '', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '0', 1, '', NULL, '', '0', '1', '', '0', 0, '0', 'en', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `model` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_no` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_on` datetime NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `model`, `type`, `other`, `license_no`, `color`, `year`, `added_on`, `user_id`, `image`) VALUES
(1, 'Toyota Siena', 'SUV', '', 'WD568', 'grey', '2005', '2022-12-10 18:58:11', 1, '9945.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `code` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`id`, `user_id`, `code`, `status`) VALUES
(1, 1, '63949e6c46bba', 0),
(3, 2, '6395b232daf53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `link`, `lang`, `page`) VALUES
(1, 'https://www.youtube.com/watch?v=AkqMQtV71Po', 'fr', 'student'),
(2, 'https://youtu.be/K68UrdUOr2Y', 'en', 'drivers'),
(3, 'https://youtu.be/11Dixobrkbw', 'en', 'student'),
(4, 'https://www.youtube.com/watch?v=j7IRe6S7txo&t', 'fr', 'drivers'),
(5, 'https://www.youtube.com/watch?v=j7IRe6S7txo&t=3s', 'en', 'passengers'),
(6, 'https://www.youtube.com/watch?v=AkqMQtV71Po', 'en', 'how-it-works');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_requests`
--

CREATE TABLE `withdrawal_requests` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `amount` float UNSIGNED NOT NULL,
  `account_no` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `on_date` datetime NOT NULL,
  `method` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_verification`
--
ALTER TABLE `admin_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancelled_seats`
--
ALTER TABLE `cancelled_seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credits_package`
--
ALTER TABLE `credits_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_verification`
--
ALTER TABLE `admin_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cancelled_seats`
--
ALTER TABLE `cancelled_seats`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credits_package`
--
ALTER TABLE `credits_package`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

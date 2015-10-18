				
		/* Menu Script */
$(document).ready(function() {
			$(".show-menu").click(function() {
				$(".sliding-menu").toggleClass("reverse out in"); 
			});
			$("#menu").click(function(){
				$(".sliding-menu").toggleClass("reverse out in");
			});
		}); 

/* Edit User Form */
	function initialize(){
		// Test to see if we support the Storage API
		var bSupportsLocal = (('localStorage' in window) && window ['localStorage'] !==null);
		// if localStorage is not supported, then bail on the demo
		if (!bSupportsLocal) {
			document.getElementById('editUser').innerHTML = "<p>Sorry, this browser does not support the storage API</p>"
			return;
			}
		// if the localStorage object has some content, restore it
		if (window.localStorage.length !=0) {
			document.getElementById('fname').value = window.localStorage.getItem('fname');
			document.getElementById('lname').value = window.localStorage.getItem('lname');
			document.getElementById('day').value = window.localStorage.getItem('day');
			document.getElementById('month').value = window.localStorage.getItem('month');
			document.getElementById('year').value = window.localStorage.getItem('year');
			document.getElementById('email').value = window.localStorage.getItem('email');
			document.getElementById('gender').value = window.localStorage.getItem('gender');
			
			document.getElementById('result').value = window.localStorage.getItem('fname');
		}
	}
			
	function storeLocalContent(fName, lName, Day, Month, Year, eMail, Gender) {
		window.localStorage.setItem('fname', fName);
		window.localStorage.setItem('lname', lName);
		window.localStorage.setItem('day', Day);
		window.localStorage.setItem('month', Month);
		window.localStorage.setItem('year', Year);
		window.localStorage.setItem('email', eMail);
		window.localStorage.setItem('gender', Gender);
		}
				
	function clearLocalContent(strToStore) {
		window.localStorage.clear();
		}
				
	window.onload=initialize;
	
/* Add Goal Form */
	function initialize(){
		// Test to see if we support the Storage API
		var bSupportsLocal = (('localStorage' in window) && window ['localStorage'] !==null);
		// if localStorage is not supported, then bail on the demo
		if (!bSupportsLocal) {
			document.getElementById('addGoal').innerHTML = "<p>Sorry, this browser does not support the storage API</p>"
			return;
			}
		// if the localStorage object has some content, restore it
		if (window.localStorage.length !=0) {
			document.getElementById('goalname').value = window.localStorage.getItem('goalname');
			document.getElementById('time').value = window.localStorage.getItem('time');
			document.getElementById('timeType').value = window.localStorage.getItem('timeType');
			document.getElementById('tags').value = window.localStorage.getItem('tags');
			document.getElementById('description').value = window.localStorage.getItem('description');
			document.getElementById('publicPrivate').value = window.localStorage.getItem('publicPrivate');
		}
	}
function storeLocalContent(goalName, Time, time_Type, Tags, Description, public_Private) {
	window.localStorage.setItem('goalname', goalName);
	window.localStorage.setItem('time', Time);
	window.localStorage.setItem('timeType', time_Type);
	window.localStorage.setItem('tags', Tags);
	window.localStorage.setItem('description', Description);
	window.localStorage.setItem('publicPrivate', public_Private);
	}
			
function clearLocalContent(strToStore) {
	window.localStorage.clear();
	}
			
window.onload=initialize;


/* Show name Script */

if (typeof(Storage) != "undefined") {   // Check browser support

        document.getElementById("result").innerHTML = localStorage.getItem("lname");  // Retrieve data
        documnet.getElementByID("result").innerHTML = localStorage.getItem("lName"); 
        } 
        
/* Follow */

$('#follow').on('click', function() {
    $.ajax({
        url : 'follow.php'
    }).done(function(data) {
        console.log(data);
    });
});
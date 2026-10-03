ECOEARTH LTD — WEBSITE
======================

Open index.html in a browser to view the site.

FILES
  index.html        Home
  about.html        About Us
  services.html     Services
  gallery.html      Gallery
  contact.html      Contact Us
  thank-you.html    Shown after the contact form is sent
  send.php          Form handler (needs PHP hosting — see below)
  images/           All photographs
  PROJECT.json      Full technical handover. Read this first if you are
                    picking the project up in a new session.

HOW IT IS BUILT
  Plain HTML and CSS. No framework, no build step.
  Each page carries its own CSS inside the file. There is no shared
  stylesheet, so a change to the header, footer or buttons must be
  repeated in every page.

  JavaScript is used in two places only:
    - the carousel on the home page
    - a twelve-line scroll-reveal on every page
  The mobile menu is CSS, not script.

PUTTING IT ONLINE
  Static hosts (GitHub Pages, Netlify): everything works except the
  contact form, because those hosts cannot run PHP. The form will do
  nothing when pressed. Tell the client.

  Real hosting with PHP (Hostinger, IONOS and similar): upload the whole
  folder. Open send.php and change $FROM to an address on the company's
  own domain, or Gmail will treat the mail as spam.

  Do not rename index.html.

STILL MISSING BEFORE LAUNCH
  1. Team names on about.html — search for [Full name]
  2. Three real quotes on index.html — search for [Name]
  3. Privacy policy, terms, modern slavery statement
  4. Cookie banner, because the Contact page loads a Google map
  5. A favicon file

WORDING THAT MUST NOT CHANGE
  EcoEarth Ltd does not hold a UK sponsor licence. The site says the
  company connects workers with UK employers who hold one, and that the
  employer issues the sponsorship. If the company obtains its own licence,
  this wording must be updated deliberately.

  A UK recruitment agency may not charge a work-seeker a fee for finding
  them work. The site does not mention a candidate fee and must not.

  The gallery photographs are stock images. The note at the bottom of that
  page says so. Do not remove it or change the captions to imply the
  pictures show real placements.

KNOWN TRAPS
  PROJECT.json has a section called regressions_caused_and_how. It lists
  nine faults introduced during the build, what caused each one, and how
  to avoid repeating it. Read it before changing layout or animation.

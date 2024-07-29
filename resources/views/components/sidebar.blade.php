<aside class="nk-sidebar">
  <div class="nk-nav-scroll">
    <ul class="metismenu" id="menu">
      <li class="nav-label">{{ __('Dashboard') }}</li>
      <li @class(['active'=> request()->routeIs('dashboard')])>
        <a href="{{ route('dashboard') }}" @class(['active'=> request()->routeIs('dashboard')])>
          <i class="icon-speedometer menu-icon"></i><span class="nav-text">{{ __('Dashboard') }}</span>
        </a>
      </li>
      <li @class(['active'=> request()->routeIs('members.*')])>
        <a href="{{ route('members.index') }}" @class(['active'=> request()->routeIs('members.*')])>
          <i class="icon-people menu-icon"></i><span class="nav-text">{{ __('Members') }}</span>
        </a>
      </li>
      <li @class(['active'=> request()->routeIs('freelancers.*')])>
        <a href="{{ route('freelancers.index') }}" @class(['active'=> request()->routeIs('freelancers.*')])>
          <i class="icon-globe-alt menu-icon"></i><span class="nav-text">{{ __('Freelancers') }}</span>
        </a>
      </li>
      <li @class(['active'=> request()->routeIs('bookings.*')])>
        <a href="{{ route('bookings.index') }}" @class(['active'=> request()->routeIs('bookings.*')])>
          <i class="icon-clock menu-icon"></i><span class="nav-text">{{ __('Bookings') }}</span>
        </a>
      </li>
      <li @class(['active'=> request()->routeIs('categories.*')])>
        <a href="{{ route('categories.index') }}" @class(['active'=> request()->routeIs('categories.*')])>
          <i class="icon-grid menu-icon"></i><span class="nav-text">{{ __('Categories') }}</span>
        </a>
      </li>
      <li @class(['active', request()->routeIs('contact-us.index')])>
        <a href="{{ route('contact-us.index') }}" @class(['active', request()->routeIs('contact-us.index')])>
          <i class="icon-phone menu-icon"></i><span class="nav-text">{{ __('Contact Us') }}</span>
        </a>
      </li>
      <li class="nav-label">{{ __('CMS') }}</li>
      <li @class(['active'=> request()->url() == route('cms.pages.show', 'terms-and-conditions')])>
        <a href="{{ route('cms.pages.show', 'terms-and-conditions') }}" @class(['active'=> request()->url() == route('cms.pages.show', 'terms-and-conditions')])>
          <i class="icon-list menu-icon"></i><span class="nav-text">{{ __('Terms & Conditions') }}</span>
        </a>
      </li>
      <li @class(['active'=> request()->url() == route('cms.pages.show', 'about-us')])>
        <a href="{{ route('cms.pages.show', 'about-us') }}" @class(['active'=> request()->url() == route('cms.pages.show', 'about-us')])>
          <i class="icon-layers menu-icon"></i><span class="nav-text">{{ __('About Us') }}</span>
        </a>
      </li>
      <li @class(['active'=> request()->routeIs('cms.faqs.*')])>
        <a href="{{ route('cms.faqs.index') }}" @class(['active'=> request()->routeIs('cms.faqs.*')])>
          <i class="icon-question menu-icon"></i><span class="nav-text">{{ __('FAQs') }}</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

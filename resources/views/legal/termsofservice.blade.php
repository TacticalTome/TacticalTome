@extends("layouts.app")

@section("pageTitle", "Terms of Service")

@section("content")
<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Terms of Service</h1>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <p class="fontTrebuchet">Last Updated: June 16th, 2021</p>

        <h1 class="fontTrebuchet">Terms of Service</h1>
        <h2 class="fontTrebuchet">1. Terms</h2>
        <p class="fontVerdana">By accessing this Website, accessible from {{ env("APP_URL") }}, you are agreeing to be bound by these Website Terms and Conditions of Use and agree that you are responsible for the agreement with any applicable local laws. If you disagree with any of these terms, you are prohibited from accessing this site. The materials contained in this Website are protected by copyright and trade mark law.</p>
        <h2 class="fontTrebuchet">2. Use License</h2>
        <p class="fontVerdana">Permission is granted to temporarily download one copy of the materials on {{ config("app.name") }}'s' Website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
        <ul class="fontVerdana">
            <li>modify or copy the materials;</li>
            <li>use the materials for any commercial purpose or for any public display;</li>
            <li>attempt to reverse engineer any software contained on {{ config("app.name") }}'s' Website;</li>
            <li>remove any copyright or other proprietary notations from the materials; or</li>
            <li>transferring the materials to another person or "mirror" the materials on any other server.</li>
        </ul>
        <p class="fontVerdana">This will let {{ config("app.name") }} to terminate upon violations of any of these restrictions. Upon termination, your viewing right will also be terminated and you should destroy any downloaded materials in your possession whether it is printed or electronic format.</p>
        <h2 class="fontTrebuchet">3. Disclaimer</h2>
        <p class="fontVerdana">All the materials on {{ config("app.name") }}’s Website are provided "as is". {{ config("app.name") }} makes no warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore, {{ config("app.name") }} does not make any representations concerning the accuracy or reliability of the use of the materials on its Website or otherwise relating to such materials or any sites linked to this Website.</p>
        <h2 class="fontTrebuchet">4. Limitations</h2>
        <p class="fontVerdana">{{ config("app.name") }} or its suppliers will not be hold accountable for any damages that will arise with the use or inability to use the materials on {{ config("app.name") }}’s Website, even if {{ config("app.name") }} or an authorize representative of this Website has been notified, orally or written, of the possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or limitations of liability for incidental damages, these limitations may not apply to you.</p>
        <h2 class="fontTrebuchet">5. Revisions and Errata</h2>
        <p class="fontVerdana">The materials appearing on {{ config("app.name") }}’s Website may include technical, typographical, or photographic errors. {{ config("app.name") }} will not promise that any of the materials in this Website are accurate, complete, or current. {{ config("app.name") }} may change the materials contained on its Website at any time without notice. {{ config("app.name") }} does not make any commitment to update the materials.</p>
        <h2 class="fontTrebuchet">6. Links</h2>
        <p class="fontVerdana">{{ config("app.name") }} has not reviewed all of the sites linked to its Website and is not responsible for the contents of any such linked site. The presence of any link does not imply endorsement by {{ config("app.name") }} of the site. The use of any linked website is at the user’s own risk.</p>
        <h2 class="fontTrebuchet">7. Site Terms of Use Modifications</h2>
        <p class="fontVerdana">{{ config("app.name") }} may revise these Terms of Use for its Website at any time without prior notice. By using this Website, you are agreeing to be bound by the current version of these Terms and Conditions of Use.</p>
        <h2 class="fontTrebuchet">8. Your Privacy</h2>
        <p class="fontVerdana">Please read our <a href="{{ route("legal.privacypolicy") }}" target="_blank">Privacy Policy</a>.</p>
        <h2 class="fontTrebuchet">9. Governing Law</h2>
        <p class="fontVerdana">Any claim related to {{ config("app.name") }} Website shall be governed by the laws of us without regards to its conflict of law provisions.</p>

        <div class="spacer" data-size="medium"></div>

        <p class="fontVerdana"><b>Our Terms of Service may change with or without notice.</b></p>
    </div>
</div>
@endsection
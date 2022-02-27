import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import pages.HomePage;
import pages.LearnMorePage;
import pages.LoginPage;
import pages.WikiPage;

import java.util.ArrayList;
import java.util.concurrent.TimeUnit;

import static org.junit.jupiter.api.Assertions.*;

public class TestLearnMoreLinks {

    static WebDriver webDriver;

    @BeforeAll
    public static void SetUp(){
        System.setProperty("webdriver.chrome.driver", "C:/Users/bures/OneDrive/Plocha/MyPlantSeleniumTest/src/main/resources/chromedriver.exe");
        webDriver = new ChromeDriver();
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/");
    }

    @AfterAll
    public static void endTest(){
        webDriver.close();
    }

    @Test
    public void testLearnMoreLinks() {
        HomePage homePage = new HomePage(webDriver);
        WebElement introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        homePage.clickLogin();
        LoginPage loginPage = homePage.clickLogin();
        WebElement signinTitle = loginPage.findSigninTitle();
        assertEquals("Sign In", signinTitle.getText());

        loginPage.fillOutForm("Chereolenlka", "TS1ahoj!");
        loginPage.sendForm();
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        LearnMorePage learnMorePage = homePage.clickLearnMore();
        introTitle = learnMorePage.getTitle();
        assertEquals("Learn more about\nindoor plants!", introTitle.getText());

        WikiPage wikiPage = learnMorePage.clickLinkAnthurium();
        WebElement wikiTitle = wikiPage.findPageTitle();
        assertEquals("Anthurium", wikiTitle.getText());

        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/learnMore");
        introTitle = learnMorePage.getTitle();
        assertEquals("Learn more about\nindoor plants!", introTitle.getText());

        wikiPage = learnMorePage.clickLinkEchinopsis();
        wikiTitle = wikiPage.findPageTitle();
        assertEquals("Echinopsis", wikiTitle.getText());

        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/learnMore");
        introTitle = learnMorePage.getTitle();
        assertEquals("Learn more about\nindoor plants!", introTitle.getText());

        wikiPage = learnMorePage.clickLinkViola();
        wikiTitle = wikiPage.findPageTitle();
        assertEquals("Viola (plant)", wikiTitle.getText());

        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/learnMore");
        introTitle = learnMorePage.getTitle();
        assertEquals("Learn more about\nindoor plants!", introTitle.getText());

        wikiPage = learnMorePage.clickLinkAzalea();
        wikiTitle = wikiPage.findPageTitle();
        assertEquals("Azalea", wikiTitle.getText());

        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/learnMore");
        introTitle = learnMorePage.getTitle();
        assertEquals("Learn more about\nindoor plants!", introTitle.getText());

        wikiPage = learnMorePage.clickLinkGeranium();
        wikiTitle = wikiPage.findPageTitle();
        assertEquals("Geranium", wikiTitle.getText());

        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/learnMore");
        introTitle = learnMorePage.getTitle();
        assertEquals("Learn more about\nindoor plants!", introTitle.getText());

    }
}

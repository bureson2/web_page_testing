import jdk.nashorn.internal.ir.annotations.Ignore;
import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import pages.*;

import java.util.concurrent.TimeUnit;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertNotEquals;

public class TestPost {

    static WebDriver webDriver;
    static HomePage homePage;
    static WebElement introTitle;
    static LoginPage loginPage;

    @BeforeAll
    public static void SetUp(){

        System.setProperty("webdriver.chrome.driver", "C:/Users/bures/OneDrive/Plocha/MyPlantSeleniumTest/src/main/resources/chromedriver.exe");
        webDriver = new ChromeDriver();
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/");
    }

    @BeforeEach
    public void SetUpAndLogin() {
        homePage = new HomePage(webDriver);
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        loginPage = homePage.clickLogin();
        loginPage.fillOutForm("Chereolenlka", "TS1ahoj!");
        loginPage.sendForm();
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());
    }

    @Test
    public void testCreatePost() {

        CreatePage createPage = homePage.clickCreate();
        WebElement createTitle = createPage.findCreateTitle();
        assertEquals("Create your post!", createTitle.getText());

        // spatne vyplnene udaje
        createPage.fillOutForm("Title1", "", "Lifehacks");
        createPage.sendForm();
        createTitle = createPage.findCreateTitle();
        assertEquals("Create your post!", createTitle.getText());

        //spravne vyplneno
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        createPage.clearInputs();
        createPage.fillOutForm("Plants", "I love plants", "Lifehacks");
        createPage.sendForm();

        PostsPage postsPage = new PostsPage(webDriver);
        WebElement postsTitle = postsPage.findPostsTitle();
        assertEquals("Latest Posts", postsTitle.getText());
    }


    @Test
    public void testUpdatePost() {

        PostsPage postsPage = homePage.clickPosts();
        WebElement postsTitle = postsPage.findPostsTitle();
        assertEquals("Latest Posts", postsTitle.getText());

        SelectedPostPage selectedPostPage = postsPage.clickReadMore();
        String postTitle = selectedPostPage.postTitle().getText();
        String postBody = selectedPostPage.postBody().getText();

        EditPostPage editPostPage = selectedPostPage.clickEditPost();
        WebElement editPostTitle = editPostPage.findCreateTitle();
        assertEquals("Edit Post", editPostTitle.getText());

        // spatne vyplnene udaje
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        editPostPage.clearInputs();
        editPostPage.fillOutForm("Title1", "", "Plant care");
        editPostPage.sendForm();

        //spravne vyplneno
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        editPostPage.clearInputs();
        editPostPage.fillOutForm("Updated plants", "I don't love plants", "Lifehacks");
        editPostPage.sendForm();

        postsPage.findPostsTitle();
        assertEquals("Latest Posts", postsTitle.getText());

        selectedPostPage = postsPage.clickReadMore();
        String updatedPostTitle = selectedPostPage.postTitle().getText();
        String updatedPostBody = selectedPostPage.postBody().getText();

        assertNotEquals(postTitle, updatedPostTitle);
        assertNotEquals(postBody, updatedPostBody);
    }

    @Test
    public void testDeletePost() {

        PostsPage postsPage = homePage.clickPosts();
        WebElement postsTitle = postsPage.findPostsTitle();
        assertEquals("Latest Posts", postsTitle.getText());

        SelectedPostPage selectedPostPage = postsPage.clickReadMore();
        String postTitleBeforeDelete = selectedPostPage.postTitle().getText();
        String postBodyBeforeDelete = selectedPostPage.postBody().getText();

        selectedPostPage.clickDeletePost();

        postsPage.findPostsTitle();
        assertEquals("Latest Posts", postsTitle.getText());

        selectedPostPage = postsPage.clickReadMore();
        String postTitleAfterDelete = selectedPostPage.postTitle().getText();
        String postBodyAfterDelete = selectedPostPage.postBody().getText();

        assertNotEquals(postTitleBeforeDelete, postTitleAfterDelete);
        assertNotEquals(postBodyBeforeDelete, postBodyAfterDelete);

    }


    @AfterAll
    public static void endTest(){
        webDriver.close();
    }

}
